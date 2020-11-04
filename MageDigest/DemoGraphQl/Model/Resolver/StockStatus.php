<?php

namespace MageDigest\DemoGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\CatalogInventory\Model\StockRegistry;

class StockStatus implements ResolverInterface
{

    public $stockRegistry;

    public function __construct(
        StockRegistry $stockRegistry
    )
    {
        $this->stockRegistry = $stockRegistry;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        if (empty($args['sku'])) {
            throw new GraphQlInputException(__('Please provide SKU'));
        }

        if ($args['is_in_stock'] != 0 && $args['is_in_stock'] != 1) {
            throw new GraphQlInputException(__('Please provide status code : 0 or 1'));
        }

        try {
            $stockItem = $this->stockRegistry->getStockItemBySku($args['sku']);
            if ($stockItem) {
                $stockItem->setIsInStock($args['is_in_stock']);
                $this->stockRegistry->updateStockItemBySku($args['sku'], $stockItem);
                return $result = array('sku' => $args['sku'], 'result' => true);
            } else
                return $result = array('sku' => $args['sku'], 'result' => false);

        } catch (\Exception $exception) {
            throw new \Exception(__($exception->getMessage()));
        }

    }

}