<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

abstract class Generate extends \Magento\Backend\App\Action
{

 
 

    const ADMIN_RESOURCE = 'Tech9logy_CouponCode::generate';


      /**
       * Core registry
       *
       * @var \Magento\Framework\Registry
       */
      protected $_coreRegistry;
    /**
     * @param \Magento\Backend\App\Action\Context              $context
     * @param \Magento\Framework\Registry                      $coreRegistry

     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }
    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Tech9logy_CouponCode::generate')
        ->addBreadcrumb(__('Generate Coupon Code'), __('Generate Coupon Code'))
        ->addBreadcrumb(__('Generate Coupon Code'), __('Generate Coupon Code'));
        return $resultPage;
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
