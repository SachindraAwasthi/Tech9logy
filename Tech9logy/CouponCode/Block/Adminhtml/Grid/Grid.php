<?php

/**

 * Copyright © Magento, Inc. All rights reserved.

 * See COPYING.txt for license details.

 */

namespace Tech9logy\CouponCode\Block\Adminhtml\Grid;

/**

 * Adminhtml block grid demo records grid block

 *

 */

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**

     * @var \Magento\Framework\Module\Manager

     */

    protected $moduleManager;

    /**

     * @var \Tech9logy\CouponCode\Model\CampaignsFactory

     */

    protected $_campaignsFactory;

    /**

     * @var \Tech9logy\CouponCode\Model\Status

     */

    // protected $_status;

    /**

     * @param \Magento\Backend\Block\Template\Context $context

     * @param \Magento\Backend\Helper\Data            $backendHelper

     * @param \Tech9logy\CouponCode\Model\CampaignsFactory              $campaignsFactory

     * @param \Tech9logy\CouponCode\Model\Status                   $status

     * @param \Magento\Framework\Module\Manager       $moduleManager

     * @param array                                   $data

     */

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Tech9logy\CouponCode\Model\CampaignsFactory $campaignsFactory,
        // \Tech9logy\CouponCode\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_campaignsFactory = $campaignsFactory;

        // $this->_status = $status;

        $this->moduleManager = $moduleManager;

        parent::__construct($context, $backendHelper, $data);
    }

    /**

     * @return void

     */

    protected function _construct()
    {
        parent::_construct();

        $this->setId("gridGrid");

        $this->setDefaultSort("id");

        $this->setDefaultDir("DESC");

        $this->setSaveParametersInSession(true);

        $this->setUseAjax(true);

        $this->setVarNameFilter("grid_record");
    }

    /**

     * @return $this

     */

    protected function _prepareCollection()
    {
        $collection = $this->_campaignsFactory->create()->getCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**

     * @return $this

     */

    protected function _prepareColumns()
    {
        $this->addColumn("id", [
            "header" => __("ID"),

            "type" => "number",

            "index" => "id",

            "header_css_class" => "col-id",

            "column_css_class" => "col-id",
        ]);

        $this->addColumn("sender_email", [
            "header" => __("Sender Email"),

            "index" => "sender_email",
        ]);

        $this->addColumn("popup_delay", [
            "header" => __("PopUp Delay Time"),

            "index" => "popup_delay",
        ]);

        $this->addColumn("heading", [
            "header" => __("Newsletter PoPup Heading"),

            "index" => "heading",
        ]);

        $this->addColumn("sub_heading", [
            "header" => __("Newsletter PoPup Sub Heading "),

            "index" => "sub_heading",
        ]);

        $this->addColumn("button_text", [
            "header" => __("Newsletter PoPup Button Text "),

            "index" => "button_text",
        ]);

        $this->addColumn("popup_mode", [
            "header" => __("Newsletter PoPup Display Mode "),

            "index" => "popup_mode",
        ]);
        $this->addColumn("cms_block_id", [
            "header" => __("Newsletter PoPup Displayed Static Block "),

            "index" => "cms_block_id",
        ]);
        $this->addColumn("edit", [
            "header" => __("Edit"),

            "type" => "action",

            "getter" => "getId",

            "actions" => [
                [
                    "caption" => __("Edit"),

                    "url" => [
                        "base" => "couponcode/grid/edit",
                    ],

                    "field" => "id",
                ],
            ],

            "filter" => false,

            "sortable" => false,

            "index" => "stores",

            "header_css_class" => "col-action",

            "column_css_class" => "col-action",
        ]);

        $this->addColumn("delete", [
            "header" => __("Delete"),

            "type" => "action",

            "getter" => "getId",

            "actions" => [
                [
                    "caption" => __("Delete"),

                    "url" => [
                        "base" => "couponcode/grid/delete",
                    ],

                    "field" => "id",
                ],
            ],

            "filter" => false,

            "sortable" => false,

            "index" => "stores",

            "header_css_class" => "col-action",

            "column_css_class" => "col-action",
        ]);

        $block = $this->getLayout()->getBlock("grid.bottom.links");

        if ($block) {
            $this->setChild("grid.bottom.links", $block);
        }

        return parent::_prepareColumns();
    }

    /**

     * @return $this

     */

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField("id");

        $this->getMassactionBlock()->setFormFieldName("id");

        $this->getMassactionBlock()->addItem("delete", [
            "label" => __("Delete"),

            "url" => $this->getUrl("couponcode/grid/massDelete"),

            "confirm" => __("Are you sure?"),
        ]);

        // $statuses = $this->_status->toOptionArray();

        // array_unshift($statuses, ["label" => "", "value" => ""]);

        // $this->getMassactionBlock()->addItem(
        //     "status",

        //     [
        //         "label" => __("Change status"),

        //         "url" => $this->getUrl("campaigns/*/massStatus", [
        //             "_current" => true,
        //         ]),

        //         "additional" => [
        //             "visibility" => [
        //                 "name" => "status",

        //                 "type" => "select",

        //                 "class" => "required-entry",

        //                 "label" => __("Status"),

        //                 "values" => $statuses,
        //             ],
        //         ],
        //     ]
        // );

        return $this;
    }

    /**

     * @return string

     */

    public function getGridUrl()
    {
        return $this->getUrl("couponcode/grid/grid", ["_current" => true]);
    }

    /**

     * @return string

     */

    public function getRowUrl($row)
    {
        return $this->getUrl("couponcode/grid/edit", ["id" => $row->getId()]);
    }
}
