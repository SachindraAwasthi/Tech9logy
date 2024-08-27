<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model\ResourceModel\Rule;

use \Tech9logy\CouponCode\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'coupon_rule_id';

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $this->getRuleAfterLoad();

        return parent::_afterLoad();
    }

    protected function _construct()
    {
        $this->_init('Tech9logy\CouponCode\Model\Rule', 'Tech9logy\CouponCode\Model\ResourceModel\Rule');
    }

    /**
     * Returns pairs email_id - email_name
     *
     * @return mixed
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('coupon_rule_id', 'name');
    }

    /**
     * Add link attribute to filter.
     *
     * @param string $code
     * @param array $condition
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        $this->performAddStoreFilter($store, $withAdmin);

        return $this;
    }

    public function setRealGroupsFilter()
    {
        return $this->addFieldToFilter('coupon_rule_id', ['gt' => 0]);
    }

    protected function getRuleAfterLoad()
    {
        $items = $this->getColumnValues("coupon_rule_id");
        if (count($items)) {
            $connection = $this->getConnection();
            foreach ($this as $item) {
                $ruleId = $item->getData('rule_id');
                $select = $connection->select()->from(['salesrule' => $this->getTable('salesrule')])->where('salesrule.rule_id = (?)', $ruleId);
                $result = $connection->fetchRow($select);

                // Add a check to ensure that the result is an array before accessing its values
                if (is_array($result)) {
                    $item->setData('name', $result['name']);
                    $item->setData('description', $result['description']);
                    $item->setData('from_date', $result['from_date']);
                    $item->setData('to_date', $result['to_date']);
                    $item->setData('times_used', $result['times_used']);
                    $item->setData('is_active', $result['is_active']);
                    $item->setData('uses_per_customer', $result['uses_per_customer']);
                    $item->setData('uses_per_coupon', $result['uses_per_coupon']);
                }
            }
        }
    }
}
