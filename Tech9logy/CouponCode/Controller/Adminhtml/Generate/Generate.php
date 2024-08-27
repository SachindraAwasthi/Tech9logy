<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Generate;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Event\Manager;
use Psr\Log\LoggerInterface;

class Generate extends Action
{
    /**
     * @var Manager
     */
    protected $eventManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        Context $context,
        Manager $eventManager,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->eventManager = $eventManager;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                $this->eventManager->dispatch('email_form_submit', ['data' => $data]);
                $this->messageManager->addSuccessMessage(__('Email sent successfully.'));
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('An error occurred while sending the email.'));
            }
        }

        $this->_redirect('*/*/'); // Redirect to the specified URL
    }
}
