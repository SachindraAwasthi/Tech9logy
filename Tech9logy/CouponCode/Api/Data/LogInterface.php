<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api\Data;

interface LogInterface
{

    const LOG_ID = 'log_id';


    /**
     * Get log_id
     * @return string|null
     */
    public function getLogId();

    /**
     * Set log_id
     * @param string $log_id
     * @return \Tech9logy\CouponCode\Api\Data\LogInterface
     */
    public function setLogId($logId);
}
