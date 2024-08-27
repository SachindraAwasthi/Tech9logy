<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Block\Account;

use Magento\Customer\Block\Account\SortLinkInterface;

class Link extends \Magento\Customer\Block\Account\Link
{
    protected $_customerUrl;
    protected $httpContext;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Url $customerUrl,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data = []
    ) {
        $this->_customerUrl = $customerUrl;
        $this->httpContext = $httpContext;
        parent::__construct($context, $customerUrl, $data);
    }

    public function getIsCustomerLoggedIn()
    {
        return $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }
}
