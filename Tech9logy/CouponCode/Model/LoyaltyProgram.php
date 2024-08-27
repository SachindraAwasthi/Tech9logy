<?php

/**
 * Copyright © Magento All rights reserved.
 *
 */

namespace Tech9logy\CouponCode\Model;

use Magento\Framework\Model\AbstractModel;
use Tech9logy\CouponCode\Model\ResourceModel\LoyaltyProgram as ResourceModel;

class LoyaltyProgram extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
