<?php

namespace Tech9logy\CouponCode\Model;

class Campaigns extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tech9logy\CouponCode\Model\ResourceModel\Campaigns');
    }
}
