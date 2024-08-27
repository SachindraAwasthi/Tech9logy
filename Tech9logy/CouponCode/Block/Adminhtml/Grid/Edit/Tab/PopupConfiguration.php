<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Tech9logy\CouponCode\Model\CampaignsFactory;

class PopupConfiguration extends Generic implements TabInterface
{
    protected $registry;
    protected $formFactory;
    protected $_blockCollectionFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        \Magento\Cms\Model\ResourceModel\Block\CollectionFactory $blockCollectionFactory,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->formFactory = $formFactory;
        $this->_blockCollectionFactory = $blockCollectionFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $model = $this->registry->registry("Tech9logy_campaigns_form_data");

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix("page_");

        $fieldset = $form->addFieldset("base_fieldset", [
            "legend" => __("Campaign Information"),
            "class" => "fieldset-wide",
        ]);

        if ($model->getId()) {
            $fieldset->addField("id", "hidden", ["name" => "id"]);
        }

        $action = $fieldset->addField("popup_mode", "select", [
            "label" => __("PopUp Template"),
            "name" => "popup_mode",
            "values" => [
                ["value" => 0, "label" => "-- Please Select --"],
                ["value" => 1, "label" => "Use Popup Template"],
                ["value" => 2, "label" => "From Static Block"],
            ],
            "note" => __("Select the PopUp Template"),
        ]);

        $anotherField = $fieldset->addField("cms_block_id", "select", [
            "label" => __(
                "Please select the Static Block To Display the newsletter Popup"
            ),
            "class" => "required-entry",
            "required" => true,
            "name" => "cms_block_id",
            "values" => $this->getcmsBlocks(),
        ]);

        $newImageField = $fieldset->addField("new_image_field", "note", [
            "label" => __("Pop Up Images"),
            "text" =>
                '<div><img src="' .
                $this->getViewFileUrl(
                    "Tech9logy_CouponCode::images/1to4pop-up-image.jpg"
                ) .
                '" /></div>',
        ]);

        $anotherField111 = $fieldset->addField("heading", "editor", [
            "name" => "heading",
            "label" => __("Heading"),
            "title" => __("Heading"),
        ]);

        $anotherField12 = $fieldset->addField("sub_heading", "text", [
            "name" => "sub_heading",
            "label" => __("Sub Heading"),
            "title" => __("Sub Heading"),
        ]);

        $anotherField19 = $fieldset->addField("button_text", "text", [
            "name" => "button_text",
            "label" => __("Button Text"),
            "title" => __("Button Text"),
        ]);

        $anotherField20 = $fieldset->addField("disclaimer", "note", [
            "name" => "disclaimer",
            "label" => __("Popup Image"),
            "title" => __("Popup Image"),
            "text" =>
                '<div><img src="' .
                $this->getViewFileUrl(
                    "Tech9logy_CouponCode::images/templatepopup.png"
                ) .
                '" /></div>',
            "note" => "Your Popup will be looks like this on the frontend",
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
                ->addFieldMap(
                    $anotherField12->getHtmlId(),
                    $anotherField12->getName()
                )
                ->addFieldMap(
                    $anotherField19->getHtmlId(),
                    $anotherField19->getName()
                )
                ->addFieldMap(
                    $anotherField20->getHtmlId(),
                    $anotherField20->getName()
                )
                ->addFieldMap(
                    $anotherField111->getHtmlId(),
                    $anotherField111->getName()
                )
                ->addFieldMap(
                    $anotherField111->getHtmlId(),
                    $anotherField111->getName()
                )
                ->addFieldMap(
                    $anotherField->getHtmlId(),
                    $anotherField->getName()
                )
                ->addFieldMap(
                    $newImageField->getHtmlId(),
                    $newImageField->getName()
                )
                ->addFieldDependence(
                    $anotherField12->getName(),
                    $action->getName(),
                    1
                )
                ->addFieldDependence(
                    $anotherField19->getName(),
                    $action->getName(),
                    1
                )
                ->addFieldDependence(
                    $anotherField20->getName(),
                    $action->getName(),
                    1
                )
                ->addFieldDependence(
                    $anotherField111->getName(),
                    $action->getName(),
                    1
                )
                ->addFieldDependence(
                    $anotherField->getName(),
                    $action->getName(),
                    2
                )
                ->addFieldDependence(
                    $newImageField->getName(),
                    $action->getName(),
                    2
                )
        );
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __("Popup Configuration");
    }

    public function getTabTitle()
    {
        return __("Popup Configuration");
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    /**
     * Return list of Static Blocks
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function getcmsBlocks()
    {
        $blockOptions = [];
        $collection = $this->_blockCollectionFactory->create();

        foreach ($collection as $block) {
            $blockOptions[] = [
                "value" => $block->getIdentifier(),
                "label" => $block->getTitle(),
            ];
        }

        return $blockOptions;
    }
}
