<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Plugin\Catalog\Block;

class Toolbar
{
    public function aroundSetCollection(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        \Closure $proceed,
        $collection
    ) {
        $currentOrder = $subject->getCurrentOrder();

        $result = $proceed($collection);

        if ($currentOrder) {
            if ($currentOrder == 'high_to_low') {
                $subject->getCollection()->setOrder('price', 'desc');
            } elseif ($currentOrder == 'low_to_high') {
                $subject->getCollection()->setOrder('price', 'asc');
            }
        } else {
            $subject->getCollection()->getSelect()->reset('order');
            $subject->getCollection()->setOrder('price', 'asc');
        }
        return $result;
    }
}
