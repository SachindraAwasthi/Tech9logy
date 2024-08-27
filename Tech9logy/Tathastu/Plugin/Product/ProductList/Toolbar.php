<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Plugin\Product\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar as Productdata;

class Toolbar
{
    public function aroundSetCollection(Productdata $subject, \Closure $proceed, $collection)
    {
        $currentOrder = $subject->getCurrentOrder();
        if ($currentOrder) {
            if ($currentOrder == "newest_product") {
                $direction = $subject->getCurrentDirection();
                $collection->getSelect()->order('created_at ' . $direction);
            }
            return $proceed($collection);
        }
    }
}
