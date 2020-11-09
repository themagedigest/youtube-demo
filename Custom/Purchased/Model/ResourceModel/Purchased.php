<?php

namespace Custom\Purchased\Model\ResourceModel;

class Purchased extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {       
        $this->_init('sales_order_items', 'item_id');
    }
}