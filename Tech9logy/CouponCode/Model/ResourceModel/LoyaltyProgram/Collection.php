<?php

/**
 * Copyright © Magento All rights reserved.
 *
 */

namespace Tech9logy\CouponCode\Model\ResourceModel\LoyaltyProgram;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tech9logy\CouponCode\Model\LoyaltyProgram as Model;
use Tech9logy\CouponCode\Model\ResourceModel\LoyaltyProgram as ResourceModel;

class Collection extends AbstractCollection
{
    
    
    protected $_idFieldName = 'couponcode_id';
    
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
