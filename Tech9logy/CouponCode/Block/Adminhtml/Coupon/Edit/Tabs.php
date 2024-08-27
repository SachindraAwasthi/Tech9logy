<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Coupon\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @param \Magento\Framework\Registry              $registry
     * @param \Magento\Backend\Block\Widget\Context    $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Backend\Model\Auth\Session      $authSession
     * @param array                                    $data
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Coupon Information'));
    }

    protected function _prepareLayout()
    {
        $rule = $this->registry->registry('tech9logycouponcode_coupon');

        $this->addTab(
            'general',
            [
                    'label' => __('Coupon Information'),
                    'content' => $this->getLayout()->createBlock('Tech9logy\CouponCode\Block\Adminhtml\Coupon\Edit\Tab\Main')->toHtml()
                ]
        );
    }
}
