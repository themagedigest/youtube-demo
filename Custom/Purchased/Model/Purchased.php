<?php

namespace Custom\Purchased\Model;

class Purchased extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Custom\Purchased\Model\ResourceModel\Purchased');
    }
}
