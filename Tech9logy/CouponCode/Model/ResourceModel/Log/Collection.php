<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\Couponcode\Model\ResourceModel\Log;

use Tech9logy\CouponCode\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _afterLoad()
    {
        return parent::_afterLoad();
    }
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tech9logy\CouponCode\Model\Log', 'Tech9logy\CouponCode\Model\ResourceModel\Log');
    }
}
