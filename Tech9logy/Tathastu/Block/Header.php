<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Block;

use Magento\Framework\View\Element\Template;

class Header extends Template
{
    public function __construct(
        Template\Context $context,
    ) {
        parent::__construct($context);
    }
    public function getText()
    {
         return "Header!";
    }
}
