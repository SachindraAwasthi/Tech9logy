<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block;

use Magento\Framework\View\Element\Template;

class Form extends Template
{
    public function getFormAction()
    {
        return $this->getUrl('couponcode/index/submit');
    }
    public function isEnabled()
    {
        return $this->_scopeConfig->isSetFlag('tech9logycouponcode/shortcode_settings/enable_shortcode');
    }
}
