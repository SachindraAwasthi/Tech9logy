<?php

namespace CustomVendor\CustomCheckoutStep\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Sales\Model\OrderFactory;

class SaveOrderDeliveryInstructions implements ObserverInterface
{
    protected $orderFactory;

    public function __construct(
        OrderFactory $orderFactory
    ) {
        $this->orderFactory = $orderFactory;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $order->setDeliveryInstructions($quote->getDeliveryInstructions());
    }
}
