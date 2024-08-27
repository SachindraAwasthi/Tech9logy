<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */

namespace Tech9logy\CouponCode\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CouponRepositoryInterface
{


    /**
     * Save Coupon
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return string
     */
    public function save();

    /**
     * Retrieve Coupon
     * @param string $couponId
     * @return \Tech9logy\CouponCode\Api\Data\CouponInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($couponId);

    /**
     * Retrieve Coupon matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tech9logy\CouponCode\Api\Data\CouponSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Coupon
     * @param \Tech9logy\CouponCode\Api\Data\CouponInterface $coupon
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tech9logy\CouponCode\Api\Data\CouponInterface $coupon
    );

    /**
     * Delete Coupon by ID
     * @param string $couponId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($couponId);
}
