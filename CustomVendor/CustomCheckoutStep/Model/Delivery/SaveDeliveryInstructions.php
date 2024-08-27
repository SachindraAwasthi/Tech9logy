<?php

namespace CustomVendor\CustomCheckoutStep\Model\Delivery;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Model\QuoteRepository;

class SaveDeliveryInstructions
{
    protected $quoteRepository;

    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    public function save(AddressInterface $address)
    {
        $extensionAttributes = $address->getExtensionAttributes();
        if ($extensionAttributes && $extensionAttributes->getDeliveryInstructions()) {
            $quote = $this->quoteRepository->getActive($address->getQuoteId());
            $quote->setDeliveryInstructions($extensionAttributes->getDeliveryInstructions());
        }
    }
}
