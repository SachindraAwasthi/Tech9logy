<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */

namespace Tech9logy\CouponCode\Api;

interface CouponManagementInterface
{


    /**
     * GET for Coupon api
     * @param string $param
     * @return string
     */
    public function getCouponAlias($alias);

    /**
     * PUT for Coupon api
     * @param string $param
     * @return string
     */
    public function putCoupon($param);

    /**
     * GET List Coupon api
     * @param string $conditions
     * @return string
     */
    public function getCouponByConditions();
}
