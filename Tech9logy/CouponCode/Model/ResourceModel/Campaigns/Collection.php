<?php

/**

 * Copyright © 2015 Magento. All rights reserved.

 * See COPYING.txt for license details.

 */

namespace Tech9logy\CouponCode\Model\ResourceModel\Campaigns;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('\Tech9logy\CouponCode\Model\Campaigns', 'Tech9logy\CouponCode\Model\ResourceModel\Campaigns');
    }
}
