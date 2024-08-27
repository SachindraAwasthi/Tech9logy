<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api\Data;

interface RuleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Rule list.
     * @return \Tech9logy\CouponCode\Api\Data\RuleInterface[]
     */
    public function getItems();

    /**
     * Set coupon_rule_id list.
     * @param \Tech9logy\CouponCode\Api\Data\RuleInterface[] $items
     * @return $this
     */
    public function setItems($items);
}
