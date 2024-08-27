<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Generate\Generate;

/**
 * Adminhtml report filter form


 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Report type options
     *
     * @var array
     */
    protected $_reportTypeOptions = [];

    /**
     * Report field visibility
     *
     * @var array
     */
    protected $_fieldVisibility = [];

    /**
     * Report field opions
     *
     * @var array
     */
    protected $_fieldOptions = [];

    protected $_helper;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Tech9logy\CouponCode\Helper\Data $helper,
        array $data = []
    ) {
        
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_helper = $helper;
    }

    /**
     * Add fieldset with general report fields
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        // die($this->_helper->getAllRule());
        $actionUrl = $this->getUrl('*/generate/generate');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'filter_form',
                    'action' => $actionUrl,
                    'method' => 'post'
                ]
            ]
        );

        $htmlIdPrefix = 'tech9logy_couponcode_generate_';
        $form->setHtmlIdPrefix($htmlIdPrefix);
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Send Coupon Code ')]);

        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);

        $fieldset->addField('store_ids', 'hidden', ['name' => 'store_ids']);

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'required' => true,
                'label' => __('Enter Name'),
                'title' =>__('Enter Name')
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'required' => true,
                'label' => __('Enter Email Address to Send Coupon Code'),
                'title' =>__('Enter Email Address to Send Coupon Code'),
                'class' => 'validate-email'
            ]
        );
        // $fieldset->addField(
        //     'coupon_rule_id',
        //     'select',
        //     [
        //         'label'    => __('Rule'),
        //         'title'    => __('Rule'),
        //         'name'     => 'coupon_rule_id',
        //         'options'  => $this->_helper->getAllRule()
        //     ]
        // );
        $fieldset->addField(
            'generate_coupon',
            'submit',
            [
                'label'    => '',
                'title'    => '',
                'class'    => 'action-secondary' ,
                'name'     => 'generate_coupon',
                'checked' => false,
                'onclick' => "filterFormSubmit()",
                'onchange' => "",
                'value' => __('Send Coupon Code'),
            ]
        );

        // $fieldset = $form->addFieldset('mass_generate_fieldset', ['legend' => __('Send Coupon for Customers '), 'class' => '.fieldset-wrapper-title, .admin__fieldset-wrapper-title']);
        // $fieldset->addField(
        //     'title',
        //     'note',
        //     ['name' => 'title', 'label' => __('Use mass-action to generate coupons for existing customers'), 'title' => __('Use mass-action to generate coupons for existing customers'), 'required' => false]
        // );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
