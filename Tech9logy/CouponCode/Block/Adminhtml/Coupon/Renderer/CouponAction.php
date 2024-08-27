<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Block\Adminhtml\Coupon\Renderer;

use Magento\Framework\UrlInterface;

class CouponAction extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{

    /**
     * @var Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @param \Magento\Backend\Block\Context
     * @param UrlInterface
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Framework\Url $urlBuilder
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context);
    }

    public function _getValue(\Magento\Framework\DataObject $row)
    {
        $editUrl = $this->_urlBuilder->getUrl(
            'couponcode/coupon/edit',
            [
                                    'couponcode_id' => $row['couponcode_id']
                                ]
        );
        return sprintf("<a target='_blank' href='%s'>Edit</a>", $editUrl);
    }
}
