<?php

namespace Test\Demo\Model\Config\Source;

class Condition extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions() {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('--Select--'), 'value' => ''],
                ['label' => __('category wise'), 'value' => 'category'],
                ['label' => __('product wise'), 'value' => 'product']
            ];
        }
        return $this->_options;
    }
}