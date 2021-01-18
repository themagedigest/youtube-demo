<?php

namespace MageDigest\CustomerReview\Model;
/**
 * Class Reviews
 * @package MageDigest\CustomerReview\Model
 */
class Reviews extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = 'md_customer_reviews';
    /**
     * @var string
     */
    protected $_cacheTag = 'md_customer_reviews';
    /**
     * @var string
     */
    protected $_eventPrefix = 'md_customer_reviews';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('MageDigest\CustomerReview\Model\ResourceModel\Reviews');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}
