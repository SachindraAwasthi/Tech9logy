<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Block;

use Magento\Framework\View\Element\Template;

class GetCategory extends Template
{
    protected $_registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
    ) {
        $this->_registry = $registry;
        parent::__construct($context);
    }

    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }
}
