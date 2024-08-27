<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api\Data;

interface RuleInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const RULE_ID = 'rule_id';
    const COUPON_RULE_ID = 'coupon_rule_id';
    const SIMPLE_ACTION = 'simple_action';
    const DISCOUNT_AMOUNT = 'discount_amount';
    const CONDITIONS = 'conditions';
    const ACTIONS = 'actions';
    const COUPONS_GENERATED = 'coupons_generated';
    const RULE_NAME = 'rule_name';
    const CODE_LENGTH = 'code_length';

    /**
     * Get rule_id
     * @return string|null
     */
    public function getRuleId();

    /**
     * Set rule_id
     * @param string $rule_id
     * @return \Tech9logy\CouponCode\Api\Data\RuleInterface
     */
    public function setRuleId($ruleId);

    /**
     * Get coupon_rule_id
     * @return string|null
     */
    public function getCouponRuleId();

    /**
     * Set coupon_rule_id
     * @param string $coupon_rule_id
     * @return \Tech9logy\CouponCode\Api\Data\RuleInterface
     */
    public function setCouponRuleId($coupon_rule_id);

    /**
     * get simple_action
     * @param string $simple_action
     * @return string|null
     */
    public function getSimpleAction();

    /**
     * Set simple_action
     * @param string $simple_action
     * @return string|null
     */
    public function setSimpleAction($simple_action);

    /**
     * get discount_amount
     * @param string $discount_amount
     * @return string|null
     */
    public function getDiscountAmount();

    /**
     * Set discount_amount
     * @param string $discount_amount
     * @return string|null
     */
    public function setDiscountAmount($discount_amount);

    /**
     * get conditions
     * @param string $conditions
     * @return string|null
     */
    public function getConditions();

    /**
     * Set conditions
     * @param string $conditions
     * @return string|null
     */
    public function setConditions($conditions);

    /**
     * get actions
     * @param string $actions
     * @return string|null
     */
    public function getActions();

    /**
     * Set actions
     * @param string $actions
     * @return string|null
     */
    public function setActions($actions);

    /**
     * get coupons_generated
     * @param string $coupons_generated
     * @return string|null
     */
    public function getCouponsGenerated();

    /**
     * Set coupons_generated
     * @param string $coupons_generated
     * @return string|null
     */
    public function setCouponsGenerated($coupons_generated);

    /**
     * get rule_name
     * @param string $rule_name
     * @return string|null
     */
    public function getRuleName();

    /**
     * Set rule_name
     * @param string $rule_name
     * @return string|null
     */
    public function setRuleName($rule_name);

    /**
     * get rule_name
     * @param string $rule_name
     * @return string|null
     */
    public function getCodeLength();

    /**
     * Set code_length
     * @param string $code_length
     * @return string|null
     */
    public function setCodeLength($code_length);
}
