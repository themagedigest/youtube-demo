<?php
namespace MageDigest\CustomerReview\Model\ResourceModel;


/**
 * Class Reviews
 * @package MageDigest\CustomerReview\Model\ResourceModel
 */
class Reviews extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *
     */
    protected function _construct() {
        $this->_init('md_customer_reviews', 'entity_id');
    }
}
