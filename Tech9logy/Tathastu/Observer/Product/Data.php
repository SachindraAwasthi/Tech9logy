<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Observer\Product;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Data implements ObserverInterface
{
    /**
     * Below is the method that will fire whenever the event runs!
     *
     * @param Observer $observer
     */
    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $url;
    public function __construct(
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->responseFactory = $responseFactory;
        $this->url = $url;
    }

    public function execute(Observer $observer)
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get('\Magento\Framework\App\Request\Http');

        if ($request->getFullActionName() == "customer_account_create") {
            $customerSession = $objectManager->get('Magento\Customer\Model\Session');
            if (!$customerSession->isLoggedIn()) {
                $redirectionUrl = $this->url->getUrl('customer/account/login');
                $this->responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();
            }
            $redirectionUrl = $this->url->getUrl('customer/account/');
            $this->responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();
        }
    }
}
