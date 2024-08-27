<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model\Config\Source;
 
class Emailtemplate implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        $data = [];
        $data[] = [
                    'value' => 'tech9logy_email_template',
                    'label' => __('Tech9logy Coupon Code Generator Email Template')
                ];
        return $data;
    }
}
