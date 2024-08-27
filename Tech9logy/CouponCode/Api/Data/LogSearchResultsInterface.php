<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api\Data;

interface LogSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Log list.
     * @return \Tech9logy\CouponCode\Api\Data\LogInterface[]
     */
    public function getItems();

    /**
     * Set log_id list.
     * @param \Tech9logy\CouponCode\Api\Data\LogInterface[] $items
     * @return $this
     */
    public function setItems($items);
}
