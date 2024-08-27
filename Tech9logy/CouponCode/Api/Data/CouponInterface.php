<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api\Data;

interface CouponInterface
{

    const COUPONCODE_ID = 'couponcode_id';
    const COUPON_ID = 'coupon_id';


    /**
     * Get coupon_id
     * @return string|null
     */
    public function getCouponId();

    /**
     * Set coupon_id
     * @param string $coupon_id
     * @return \Tech9logy\CouponCode\Api\Data\CouponInterface
     */
    public function setCouponId($couponId);

    /**
     * Get couponcode_id
     * @return string|null
     */
    public function getCouponcodeId();

    /**
     * Set couponcode_id
     * @param string $couponcode_id
     * @return \Tech9logy\CouponCode\Api\Data\CouponInterface
     */
    public function setCouponcodeId($couponcode_id);
}
