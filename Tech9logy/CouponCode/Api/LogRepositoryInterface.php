<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LogRepositoryInterface
{


    /**
     * Save Log
     * @param \Tech9logy\CouponCode\Api\Data\LogInterface $log
     * @return \Tech9logy\CouponCode\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Tech9logy\CouponCode\Api\Data\LogInterface $log
    );

    /**
     * Retrieve Log
     * @param string $logId
     * @return \Tech9logy\CouponCode\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($logId);

    /**
     * Retrieve Log matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tech9logy\CouponCode\Api\Data\LogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Log
     * @param \Tech9logy\CouponCode\Api\Data\LogInterface $log
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tech9logy\CouponCode\Api\Data\LogInterface $log
    );

    /**
     * Delete Log by ID
     * @param string $logId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($logId);
}
