<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api;

interface RuleManagementInterface
{


    /**
     * GET for Rule api
     * @param string $param
     * @return string
     */
    public function getRule();

    /**
     * POST for Rule api
     * @param string $param
     * @return string
     */
    public function postRule($param);

    /**
     * DELETE for Rule api
     * @param string $param
     * @return string
     */
    public function deleteRule($param);

    /**
     * PUT for Rule api
     * @param string $param
     * @return string
     */
    public function putRule($param);
}
