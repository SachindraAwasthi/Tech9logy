<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Block\Adminhtml\Generate;

class Generate extends \Magento\Backend\Block\Widget\Container
{
    /**
     * Template
     *
     * @var string
     */
    protected $_template = 'Tech9logy_CouponCode::coupon/grid/container.phtml';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Tech9logy_CouponCode';
        $this->_controller = 'adminhtml_generate';
        $this->_headerText = __(' Generate Coupon Code');
        parent::_construct();
    }
    /**
     * Get filter URL
     *
     * @return string
     */
    public function getFilterUrl()
    {
        $this->getRequest()->setParam('filter', null);
        return $this->getUrl('*/generate/generate', ['_current' => true]);
    }
}
