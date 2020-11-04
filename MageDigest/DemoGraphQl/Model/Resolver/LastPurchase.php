<?php

namespace MageDigest\DemoGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Validator\EmailAddress as EmailValidator;
use MageDigest\DemoGraphQl\Model\Customer\Order as CustomerOrder;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class LastPurchase
 * @package MageDigest\DemoGraphQl\Model\Resolver
 */
class LastPurchase implements ResolverInterface
{
    /**
     * @var CustomerOrder
     */
    public $customerOrder;

    /**
     * @var EmailValidator
     */
    public $emailValidator;

    /**
     * LastPurchase constructor.
     * @param CustomerOrder $customerOrder
     * @param EmailValidator $emailValidator
     */
    public function __construct(
        CustomerOrder $customerOrder,
        EmailValidator $emailValidator
    )
    {
        $this->customerOrder = $customerOrder;
        $this->emailValidator = $emailValidator;
    }


    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|\Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     * @throws GraphQlInputException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        if (empty($args['email'])) {
            throw new GraphQlInputException(__('Email must be specified'));
        }

        if (!$this->emailValidator->isValid($args['email'])) {
            throw new GraphQlInputException(__('Email must be valid'));
        }

        try {
            $latestOrderItems = $this->customerOrder->getLatestOrder($args["email"]);
        } catch (NoSuchEntityException $exception) {
            throw new NoSuchEntityException(__($exception->getMessage()));
        }

        return $latestOrderItems;

    }

}