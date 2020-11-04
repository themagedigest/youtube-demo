<?php

namespace MageDigest\DemoGraphQl\Model\Customer;

use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;


/**
 * Class Order
 * @package MageDigest\DemoGraphQl\Model\Customer
 */
class Order
{

    /**
     * @var OrderFactory
     */
    public $orderFactory;

    /**
     * @var CollectionFactory
     */
    public $orderCollectionFactory;

    /**
     * Order constructor.
     * @param OrderFactory $orderFactory
     * @param CollectionFactory $orderCollectionFactory
     */
    public function __construct(
        OrderFactory $orderFactory,
        CollectionFactory $orderCollectionFactory
    )
    {
        $this->orderFactory = $orderFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
    }


    /**
     * @param $email
     * @return array
     */
    public function getLatestOrder($email)
    {
        $orderCollection = $this->orderCollectionFactory->create()
            ->addFieldToFilter('customer_email', $email)->setOrder('created_at', 'DESC')->getFirstItem();
        $result = array();
        $order = $this->orderFactory->create()->loadByIncrementId($orderCollection->getIncrementId());
        foreach ($order->getAllItems() as $item) {
            $result[] = array('name' => $item->getName(), 'sku' => $item->getSku());
        }
        return $result;

    }
}