<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */

namespace Tech9logy\CouponCode\Model;

class RuleManagement
{
    protected $_objectManager;
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->_objectManager = $objectManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getRule()
    {
        $coupon_model = $this->_objectManager->create('Tech9logy\CouponCode\Model\ResourceModel\Rule')->getRuleData();
        return json_encode($coupon_model);
    }

    /**
     * {@inheritdoc}
     */
    public function postRule($param)
    {
        return 'hello api POST return the $param ' . $param;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteRule($param)
    {
        return 'hello api DELETE return the $param ' . $param;
    }

    /**
     * {@inheritdoc}
     */
    public function putRule($param)
    {
        return 'hello api PUT return the $param ' . $param;
    }
}
