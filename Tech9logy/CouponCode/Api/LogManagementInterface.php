<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */

namespace Tech9logy\CouponCode\Api;

interface LogManagementInterface
{


    /**
     * GET for Log api
     * @param string $coupon_code
     * @param string $email
     * @return string
     */
    public function getLog($coupon_code, $email);
}
