<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory as RuleCollectionFactory;

class Main extends Generic implements TabInterface
{
    protected $objectManager;
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
        ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        $this->_status = $status;
        $this->_adminSession = $adminSession;
        $this->objectManager = $objectManager;
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
        $fieldset->addField("sender_email", "select", [
            "name" => "sender_email",
            "label" => __("Sender Email Id"),
            "title" => __("Sender Email Id"),
            "required" => true,
            "class" => "required-entry",
            "values" => $this->getStoreEmailOptions(),
            "note" => __(
                "These Emails are rendering from the store email addresses"
            ),
        ]);

        // $fieldset->addField("cart_price_rule_id", "select", [
        //     "name" => "cart_price_rule_id",
        //     "label" => __("Select Cart Price Rule"),
        //     "title" => __("Select Cart Price Rule"),
        //     "values" => $this->getCartPriceRulesOptions(),
        // ]);
        // Add a dropdown field for email templates
        $emailTemplates = $this->getEmailTemplatesOptions(); // Define this function to fetch email templates
        // $fieldset->addField("email_template", "select", [
        //     "name" => "email_template",
        //     "label" => __("Select Email Template"),
        //     "title" => __("Select Email Template"),
        //     "required" => true,
        //     "class" => "required-entry",
        //     "values" => $emailTemplates,
        // ]);

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
        return __("General Settings");
    }

    /**
     * Retrieve title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __("General Settings");
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
    /**
     * Get email templates options
     *
     * @return array
     */
    protected function getEmailTemplatesOptions()
    {
        $options = [["value" => "", "label" => __("-- Please Select --")]];

        // Get the list of email templates
        $templateOptions = $this->objectManager
            ->get(\Magento\Email\Model\ResourceModel\Template\Collection::class)
            ->toOptionArray();

        // Combine options
        $options = array_merge($options, $templateOptions);

        return $options;
    }

    /**
     * Get store email options
     *
     * @return array
     */
    protected function getStoreEmailOptions()
    {
        $options = [["value" => "", "label" => __("-- Please Select --")]];

        // Get the list of store email addresses
        $storeManager = $this->objectManager->get(StoreManagerInterface::class);

        foreach ($storeManager->getStores() as $store) {
            $storeEmails = $store->getConfig("trans_email/ident_general/email");
            $storeEmails = explode(",", $storeEmails);

            foreach ($storeEmails as $email) {
                $email = trim($email);
                if (!empty($email) &&
                    !in_array($email, array_column($options, "value"))
                ) {
                    $options[] = ["value" => $email, "label" => $email];
                }
            }
        }

        return $options;
    }

    /**
     * Get Cart Price Rules options
     *
     * @return array
     */
    protected function getCartPriceRulesOptions()
    {
        $options = [["value" => "", "label" => __("-- Please Select --")]];

        // Get the list of Cart Price Rules
        $ruleCollection = $this->objectManager
            ->get(RuleCollectionFactory::class)
            ->create();
        foreach ($ruleCollection as $rule) {
            $options[] = [
                "value" => $rule->getId(),
                "label" => $rule->getName(),
            ];
        }

        return $options;
    }
}
