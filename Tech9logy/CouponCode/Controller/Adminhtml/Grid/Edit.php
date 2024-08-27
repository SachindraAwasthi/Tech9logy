<?php

namespace Tech9logy\CouponCode\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Tech9logy\CouponCode\Model\CampaignsFactory
     */
    protected $campaignsFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Tech9logy\CouponCode\Model\CampaignsFactory $campaignsFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Tech9logy\CouponCode\Model\CampaignsFactory $campaignsFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->campaignsFactory = $campaignsFactory;
        parent::__construct($context);
    }

    /**
     * Check permission to access this controller
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("Tech9logy_CouponCode::grid");
    }

    /**
     * Initialize action
     *
     * @return $this
     */
    protected function _initAction()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu("Tech9logy_CouponCode::grid");
        $resultPage->addBreadcrumb(__("Campaigns"), __("Campaigns"));
        $resultPage->addBreadcrumb(
            __("Manage Campaigns"),
            __("Manage Campaigns")
        );
        return $resultPage;
    }
    /**
     * Get URL for saving the form data
     *
     * @return string
     */
    protected function getSaveUrl()
    {
        return $this->getUrl("couponcode/*/save"); // Adjust the route as per your module
    }

    /**
     * Edit Campaigns item
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam("id");
        $model = $this->campaignsFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(
                    __("This campaign no longer exists.")
                );
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath("*/*/");
            }
        }

        $data = $model->getData();
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register("Tech9logy_campaigns_form_data", $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __("Edit Campaign") : __("New Campaign"),
            $id ? __("Edit Campaign") : __("New Campaign")
        );
        $resultPage
            ->getConfig()
            ->getTitle()
            ->prepend(
                $model->getId() ? $model->getTitle() : __("New Campaign")
            );

        // Set action URL for the form block
        $formBlock = $resultPage->getLayout()->getBlock("grid_edit");
        if ($formBlock) {
            $formBlock->setData("action", $this->getSaveUrl());
        }

        return $resultPage;
    }
}
