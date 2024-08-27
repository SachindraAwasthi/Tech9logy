<?php

namespace Tech9logy\CouponCode\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**

     * @var PageFactory

     */

    protected $resultPageFactory;

    /**

     * @param Context     $context

     * @param PageFactory $resultPageFactory

     */

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    /**

     * @return \Magento\Framework\View\Result\PageFactory

     */

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu("Tech9logy_CouponCode::grid");

        $resultPage->addBreadcrumb(
            __("Manage Grid View"),
            __("Manage Grid View")
        );

        $resultPage
            ->getConfig()
            ->getTitle()
            ->prepend(__("Manage Campaigns"));

        return $resultPage;
    }
}
