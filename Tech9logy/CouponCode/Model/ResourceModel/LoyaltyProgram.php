<?php

/**
 * Copyright © Magento All rights reserved.
 *
 */

namespace Tech9logy\CouponCode\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class LoyaltyProgram extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('tech9logy_couponcode_coupon', 'couponcode_id');
    }
}
