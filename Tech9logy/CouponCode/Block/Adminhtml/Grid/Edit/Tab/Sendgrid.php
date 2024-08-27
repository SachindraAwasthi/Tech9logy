<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Tech9logy\CouponCode\Model\ResourceModel\Rule\CollectionFactory as RuleCollectionFactory;
use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory as RulesCollectionFactory;
use Magento\Cms\Model\Wysiwyg\Config;

class Sendgrid extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    /** @var RuleCollectionFactory */
    protected $ruleCollectionFactory;
    protected $rulesCollectionFactory;
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
        RuleCollectionFactory $ruleCollectionFactory,
        RulesCollectionFactory $rulesCollectionFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_status = $status;
        $this->_adminSession = $adminSession;
        $this->ruleCollectionFactory = $ruleCollectionFactory;
        $this->rulesCollectionFactory = $rulesCollectionFactory;
        $this->_wysiwygConfig = $wysiwygConfig;
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
        $action = $fieldset->addField("sendgrid_mode", "select", [
            "label" => __("Call Of Action"),
            "class" => "required-entry",
            "name" => "sendgrid_mode",
            "values" => [
                ["value" => 0, "label" => __("-- Please Select --")],
                [
                    "value" => 1,
                    "label" => __("With Dynamic Coupon Code Rules"),
                ],
                ["value" => 2, "label" => __("With Cart Price Rules")],
                ["value" => 3, "label" => __("No Coupon Codes")],
            ],
        ]);

        // $rules = $this->ruleCollectionFactory->create();
        // $ruleOptions = [];
        // foreach ($rules as $rule) {
        //     $ruleOptions[] = [
        //         "value" => $rule->getId(),
        //         "label" => $rule->getId() . " - " . $rule->getName(),
        //     ];
        // }
        // Fetch custom rules
        $customRules = $this->ruleCollectionFactory->create();
        $customRuleOptions = [];
        foreach ($customRules as $rule) {
            $customRuleOptions[] = [
            "value" => $rule->getId(),
            "label" => $rule->getId() . " - " . $rule->getName(),
            ];
        }

    // Fetch default cart price rules
        $defaultRules = $this->rulesCollectionFactory->create()
        ->addFieldToFilter("coupon_type", ["eq" => \Magento\SalesRule\Model\Rule::COUPON_TYPE_SPECIFIC]);
        $defaultRuleOptions = [];
        foreach ($defaultRules as $rule) {
            $defaultRuleOptions[] = [
            "value" => $rule->getId(),
            "label" => $rule->getId() . " - " . $rule->getName(),
            ];
        }

    // Merge both sets of rules
        $allRuleOptions = array_merge(
            [["value" => "", "label" => __("-- Please Select --")]],
            $customRuleOptions,
            $defaultRuleOptions
        );
        $anotherField = $fieldset->addField("sendgrid_list_id", "select", [
            "name" => "sendgrid_list_id",
            "label" => __("Select Dynamic Coupon Codes Rules"),
            "title" => __("Select Dynamic Coupon Codes Rules"),
            "required" => true,
            "class" => "required-entry",
            "values" => array_merge(
                [["value" => "", "label" => __("-- Please Select --")]],
                $allRuleOptions
            ),
        ]);
        $rules = $this->rulesCollectionFactory
            ->create()
            ->addFieldToFilter("coupon_type", [
                "eq" => \Magento\SalesRule\Model\Rule::COUPON_TYPE_SPECIFIC,
            ]);
        $ruleOptions = [];
        foreach ($rules as $rule) {
            $ruleOptions[] = [
                "value" => $rule->getId(),
                "label" => $rule->getId() . " - " . $rule->getName(),
            ];
        }
        $anotherField1 = $fieldset->addField("specific_coupon", "text", [
            "name" => "specific_coupon",
            "label" => __("Please Enter Coupon Code."),
            "title" => __("Please Enter Coupon Code."),
            "required" => true,
            "class" => "required-entry",
            // "values" => array_merge(
            //     [["value" => "", "label" => __("-- Please Select --")]],
            //     $ruleOptions
            // ),
        ]);
        $this->setChild(
            "form_after",
            $this->getLayout()
                ->createBlock(
                    "\Magento\Backend\Block\Widget\Form\Element\Dependence"
                )
                ->addFieldMap($action->getHtmlId(), $action->getName())
                ->addFieldMap(
                    $anotherField->getHtmlId(),
                    $anotherField->getName()
                )

                ->addFieldMap($action->getHtmlId(), $action->getName())
                ->addFieldMap(
                    $anotherField->getHtmlId(),
                    $anotherField->getName()
                )
                ->addFieldMap(
                    $anotherField1->getHtmlId(),
                    $anotherField1->getName()
                )
                ->addFieldDependence(
                    $anotherField->getName(),
                    $action->getName(),
                    1
                )
                ->addFieldDependence(
                    $anotherField1->getName(),
                    $action->getName(),
                    2
                )
        );
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
