<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface RuleRepositoryInterface
{


    /**
     * Save Rule
     * @param \Tech9logy\CouponCode\Api\Data\RuleInterface $rule
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    // public function save(\Tech9logy\CouponCode\Api\Data\RuleInterface $rule);
    public function save(\Tech9logy\CouponCode\Api\Data\RuleInterface $rule);

    /**
     * Retrieve Rule
     * @param string $ruleId
     * @return \Tech9logy\CouponCode\Api\Data\RuleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($ruleId);

    /**
     * Retrieve Rule matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Tech9logy\CouponCode\Api\Data\RuleSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Rule
     * @param \Tech9logy\CouponCode\Api\Data\RuleInterface $rule
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Tech9logy\CouponCode\Api\Data\RuleInterface $rule
    );

    /**
     * Delete Rule by ID
     * @param string $ruleId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($ruleId);
}
