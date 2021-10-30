<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageDigest\CustomPayment\Model;

/**
 * Custom payment method model
 *
 * @method \Magento\Quote\Api\Data\PaymentMethodExtensionInterface getExtensionAttributes()
 *
 * @api
 * @since 100.0.2
 */
class Custompayment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const CUSTOM_PAYMENT_CODE = 'custompayment';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::CUSTOM_PAYMENT_CODE;

    /**
     * Custom payment block paths
     *
     * @var string
     */
    protected $_formBlockType = \MageDigest\CustomPayment\Block\Form\Custompayment::class;

    /**
     * Info instructions block path
     *
     * @var string
     */
    protected $_infoBlockType = \Magento\Payment\Block\Info\Instructions::class;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions'));
    }
}
