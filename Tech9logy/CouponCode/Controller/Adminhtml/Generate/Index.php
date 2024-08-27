<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Generate;

use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $_dateFilter;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
     * @param TimezoneInterface $timezone
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter,
        TimezoneInterface $timezone
    ) {
        parent::__construct($context);
        $this->_fileFactory = $fileFactory;
        $this->_dateFilter = $dateFilter;
        $this->timezone = $timezone;
    }

    /**
     * Add report breadcrumbs
     *
     * @return $this
     */
    public function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Tech9logy_CouponCode::generate'
        )->_addBreadcrumb(
            __('Send Coupon Code'),
            __('Send Coupon Code')
        );
        return $this;
    }

    public function execute()
    {
        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Send Coupon Code'));
        // $this->_view->getLayout()->getBlock('grid.filter.form');

        $this->_view->renderLayout();
    }
     /**
      * Check the permission to run it
      *
      * @return boolean
      */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tech9logy_CouponCode::generate');
    }
}
