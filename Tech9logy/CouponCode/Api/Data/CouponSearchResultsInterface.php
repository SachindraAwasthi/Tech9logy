<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api\Data;

interface CouponSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Coupon list.
     * @return \Tech9logy\CouponCode\Api\Data\CouponInterface[]
     */
    public function getItems();

    /**
     * Set couponcode_id list.
     * @param \Tech9logy\CouponCode\Api\Data\CouponInterface[] $items
     * @return $this
     */
    public function setItems($items);
}
