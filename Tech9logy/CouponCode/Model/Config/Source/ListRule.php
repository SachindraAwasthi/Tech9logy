<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model\Config\Source;
 
class ListRule implements \Magento\Framework\Option\ArrayInterface
{
    protected $_couponHelper;

    /**
     * @param \Tech9logy\CouponCode\Helper\Data $couponHelper
     */
    public function __construct(
        \Tech9logy\CouponCode\Helper\Data $couponHelper
    ) {
        $this->_couponHelper = $couponHelper;
    }
    public function toOptionArray()
    {
        $collection = $this->_couponHelper->getAllRule();
        $rules = [];
        foreach ($collection as $key => $val) {
            $rules[] = [
            'value' => $key,
            'label' => addslashes($val)
            ];
        }
        array_unshift($rules, [
                'value' => '',
                'label' => __('-- Please Select A Rule --'),
                ]);
        return $rules;
    }
}
