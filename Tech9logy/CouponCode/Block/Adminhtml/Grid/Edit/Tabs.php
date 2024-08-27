<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**

     * @return void

     */

    protected function _construct()
    {
        parent::_construct();

        $this->setId("grid_record");

        $this->setDestElementId("edit_form");

        $this->setTitle(__("General Information"));
    }
    /**
     * Prepare form data
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareLayout()
    {
        // $this->addTab(
        //     'main',
        //     [
        //         'label' => __('General Information'),
        //         'content' => $this->getLayout()->createBlock(
        //             'Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab\Main'
        //         )->toHtml(),
        //         'active' => true
        //     ]
        // );
        $this->addTab("popup", [
            "label" => __("Designing"),
            "content" => $this->getLayout()
                ->createBlock(
                    "Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab\PopupConfiguration"
                )
                ->toHtml(),
        ]);
        $this->addTab("design", [
            "label" => __("Configuration"),
            "content" => $this->getLayout()
                ->createBlock(
                    "Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab\PopupDesign"
                )
                ->toHtml(),
        ]);
        $this->addTab("sendgrid", [
            "label" => __("Call Of Action"),
            "content" => $this->getLayout()
                ->createBlock(
                    "Tech9logy\CouponCode\Block\Adminhtml\Grid\Edit\Tab\Sendgrid"
                )
                ->toHtml(),
            "active" => true,
        ]);
        return parent::_prepareLayout();
    }
}
