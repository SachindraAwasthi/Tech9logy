<?php
 
namespace Tech9logy\CouponCode\Block\Adminhtml\Rule\Edit;

class Tab extends \Magento\Backend\Block\Widget\Tab
{
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}
