<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Event\Manager;
use Psr\Log\LoggerInterface;
use Magento\Framework\Controller\ResultFactory;

class Submit extends Action
{
    protected $eventManager;
    protected $logger;
    protected $resultFactory;

    public function __construct(
        Context $context,
        Manager $eventManager,
        LoggerInterface $logger,
        ResultFactory $resultFactory
    ) {
        parent::__construct($context);
        $this->eventManager = $eventManager;
        $this->logger = $logger;
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('*/*/');
            return $resultRedirect;
        }

        try {
            $this->eventManager->dispatch('couponcode_form_submit', ['data' => $data]);
            $this->messageManager->addSuccessMessage(__('Email sent successfully.'));
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage(__('An error occurred while sending the email.'));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('couponcode/index/welcome');
        return $resultRedirect;
    }
}
