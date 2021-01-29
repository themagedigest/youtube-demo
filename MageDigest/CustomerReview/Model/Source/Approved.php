<?php

namespace MageDigest\CustomerReview\Model\Source;

/**
 * Class Approved
 * @package MageDigest\CustomerReview\Model\Source
 */
class Approved implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve status options array.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('No')],
            ['value' => 1, 'label' => __('Yes')]
        ];
    }
}
