<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;

use Magento\Backend\Block\Widget\Tab\TabInterface;

class PopupDesign extends Generic implements TabInterface
{
    /**

     * Core registry

     *

     * @var \Magento\Framework\Registry

     */

    protected $_coreRegistry = null;

    /**

     * @var \Magento\Backend\Model\Auth\Session

     */

    protected $_adminSession;

    /**

     * @var \Tech9logy\CouponCode\Model\Status

     */

    protected $_status;

    /**

     * @param \Magento\Backend\Block\Template\Context $context

     * @param \Magento\Framework\Registry             $registry

     * @param \Magento\Framework\Data\FormFactory     $formFactory

     * @param \Magento\Backend\Model\Auth\Session     $adminSession

     * @param \Tech9logy\CouponCode\Model\Status                   $status

     * @param array                                   $data

     */

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Tech9logy\CouponCode\Model\Status $status,
        array $data = []
    ) {
        $this->_status = $status;

        $this->_adminSession = $adminSession;

        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Prepare form data
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry(
            "Tech9logy_campaigns_form_data"
        );
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix("page_");
        $fieldset = $form->addFieldset("base_fieldset", [
            "legend" => __("Campaign Information"),
            "class" => "fieldset-wide",
        ]);
        $fieldset->addField("popup_delay", "text", [
            "name" => "popup_delay",
            "label" => __("Enter PopUP Delay Time"),
            "title" => __("Enter PopUP Delay Time"),
            "required" => true,
            "class" => "required-entry",
            "note" => __("Enter time in seconds"),
        ]);
        $fieldset->addField("display_mode_home", "select", [
            "name" => "display_mode_home",
            "label" => __("Select PopUp Display Mode"),
            "title" => __("Select PopUp Display Mode"),
            "required" => true,
            "values" => [
                ["value" => 1, "label" => __("Display On Every Page")],
                ["value" => 0, "label" => __("Display Only On Home Page")],
            ],
        ]);
        // $fieldset->addField(
        //     'page_visiting',
        //     'text',
        //     [
        //         'name' => 'page_visiting',
        //         'label' => __('Display After Page Visiting'),
        //         'title' => __('Display After Page Visiting'),
        //         'required' => true,
        //         'class' => 'required-entry',
        //         "note" => __("Please Enter in Numbers like 1 2 3 ")
        //     ]
        // );
        // $fieldset->addField(
        //     'display_on_mobile',
        //     'select',
        //     [
        //         'name' => 'display_on_mobile',
        //         'label' => __('Display On Mobile Devices'),
        //         'title' => __('Display On Mobile Devices'),
        //         'required' => true,
        //         'values' => [
        //             ['value' => 1, 'label' => __('Yes')],
        //             ['value' => 0, 'label' => __('No')],
        //         ],
        //     ]
        // );
        $fieldset->addField("close_popup", "select", [
            "name" => "close_popup",
            "label" => __("PopUP Close Mode"),
            "title" => __("PopUP Close Mode"),
            "required" => true,
            "values" => [
                [
                    "value" => 1,
                    "label" => __("Close Only When Close Button Is Clicked"),
                ],
                ["value" => 0, "label" => __("Close When Clicked Outside")],
            ],
        ]);

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
    /**
     * Retrieve label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __("SendGrid Tab Label");
    }

    /**
     * Retrieve title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __("SendGrid Tab Title");
    }

    /**
     * Check if tab can be shown
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Check if tab is hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
