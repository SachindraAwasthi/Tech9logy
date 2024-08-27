<?php
 
namespace Tech9logy\CouponCode\Block\Adminhtml\Rule\Edit\Tab;

use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Convert\DataObject as ObjectConverter;

class CouponInfo extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Sales rule coupon
     *
     * @var \Magento\SalesRule\Helper\Coupon
     */
    protected $_salesRuleCoupon = null;

    /**
     * [__construct description]
     * @param \Magento\Backend\Block\Template\Context                       $context
     * @param \Magento\Framework\Registry                                   $registry
     * @param \Magento\Framework\Data\FormFactory                           $formFactory
     * @param \Magento\SalesRule\Helper\Coupon                              $salesRuleCoupon
     * @param array                                                         $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\SalesRule\Helper\Coupon $salesRuleCoupon,
        array $data = []
    ) {
        $this->_salesRuleCoupon = $salesRuleCoupon;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        /**
         * @var \Magento\SalesRule\Helper\Coupon $couponHelper
         */
        $couponHelper = $this->_salesRuleCoupon;

        $model = $this->_coreRegistry->registry('tech9logycouponcode_rule');
        if ($model === null) {
            return parent::_prepareForm();
        }

        if ($this->_isAllowedAction('Tech9logy_CouponCode::rule_edit')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $this->_eventManager->dispatch(
            'tech9logy_check_license',
            ['obj' => $this,'ex'=>'Tech9logy_CouponCode']
        );

        if ($this->hasData('is_valid') && $this->hasData('local_valid') && !$this->getData('is_valid') && !$this->getData('local_valid')) {
            $isElementDisabled = true;
        }

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('General Information')]);
        if ($model->getId()) {
            $fieldset->addField('coupon_rule_id', 'hidden', ['name' => 'coupon_rule_id']);
        }
        
        $fieldset->addField(
            'coupons_length',
            'text',
            [
                'name' => 'coupons_length',
                'label' => __('Code Length'),
                'title' => __('Code Length'),
                'required' => true,
                'note' => __('Excluding prefix, suffix, and separators.'),
                'value' => $couponHelper->getDefaultLength(),
                'class' => 'validate-digits validate-greater-than-zero',
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'coupons_format',
            'select',
            [
                'label' => __('Code Format'),
                'name' => 'coupons_format',
                'options' => $couponHelper->getFormatsList(),
                'required' => true,
                'value' => $couponHelper->getDefaultFormat(),
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'coupons_prefix',
            'text',
            [
                'name' => 'coupons_prefix',
                'label' => __('Code Prefix'),
                'title' => __('Code Prefix'),
                'value' => $couponHelper->getDefaultPrefix(),
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'coupons_suffix',
            'text',
            [
                'name' => 'coupons_suffix',
                'label' => __('Code Suffix'),
                'title' => __('Code Suffix'),
                'value' => $couponHelper->getDefaultSuffix(),
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'coupons_dash',
            'text',
            [
                'name' => 'coupons_dash',
                'label' => __('Dash Every X Characters'),
                'title' => __('Dash Every X Characters'),
                'note' => __('If empty, no separation.'),
                'value' => $couponHelper->getDefaultDashInterval(),
                'class' => 'validate-digits',
                'disabled' => $isElementDisabled
            ]
        );
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Coupon Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Coupon Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
