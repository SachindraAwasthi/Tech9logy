<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\CouponCode\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class FooterConfig extends Template
{
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getAboutLink()
    {
        return $this->scopeConfig->getValue('footer_settings/quick_links/about_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getContactLink()
    {
        return $this->scopeConfig->getValue('footer_settings/quick_links/contact_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMensLink()
    {
        return $this->scopeConfig->getValue('footer_settings/categories/mens_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    // Add methods for other fields as needed
}
