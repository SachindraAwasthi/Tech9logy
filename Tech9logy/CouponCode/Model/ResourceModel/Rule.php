<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Model\ResourceModel;

/**
 * CMS block model
 */
class Rule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    const RULE_ID = 'rule_id';
    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string|null $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->_storeManager = $storeManager;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tech9logy_couponcode_rule', 'coupon_rule_id');
    }

    /**
     * Retrieve default attribute set id
     *
     * @return int
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Magento\Catalog\Model\Product::ENTITY);
        }
    }

    /**
     * @inheritdoc
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($attribute = $object->getData('customer_group_ids')) {
            $table = $this->getTable('salesrule_customer_group');
            $where = ['rule_id = ?' => (int)$object->getRuleId()];
            $this->getConnection()->delete($table, $where);
            $data = [];
            foreach ($attribute as $k => $_attribute) {
                $data[] = [
                'customer_group_id' => $_attribute,
                'rule_id' => (int)$object->getRuleId()
                ];
            }
            $this->getConnection()->insertMultiple($table, $data);
        }
        if ($stores = $object->getData('website_ids')) {
            $table = $this->getTable('salesrule_website');
            $where = ['rule_id = ?' => (int)$object->getRuleId()];
            $this->getConnection()->delete($table, $where);
            if ($stores) {
                $data = [];
                foreach ($stores as $storeId) {
                    $data[] = ['rule_id' => (int)$object->getRuleId(), 'website_id' => (int)$storeId];
                }
                try {
                    $this->getConnection()->insertMultiple($table, $data);
                } catch (\Exception $e) {
                    throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
                }
            }
        }

        return parent::_afterSave($object);
    }

    /**
     * Perform operations after object load
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($object->getData(self::RULE_ID)) {
            // Set SalesRule Data
            $salesrule = $this->lookupSalesRule($object->getId());
            $object->setData($salesrule);
    
            // Set Customer Group Ids Data
            $customerGroups = $this->lookupCustomerGroupIds($object->getData(self::RULE_ID));
            $object->setData('customer_group_ids', $customerGroups);
            $object->setData('customer_groups', $customerGroups);
    
            // Set Website Ids Data
            $stores = $this->lookupStoreIds($object->getData(self::RULE_ID));
            $object->setData('website_ids', $stores);
            $object->setData('website_id', $stores);
        }
        return parent::_afterLoad($object);
    }

    /**
     * Get store ids to which specified item is assigned
     *
     * @param int $id
     * @return mixed
     */
    public function lookupStoreIds($id)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from(
                $this->getTable('salesrule_website'),
                'website_id'
            )->where(
                'rule_id = :rule_id'
            );
        $binds = [':rule_id' => (int)$id];
        return $connection->fetchCol($select, $binds);
    }

    /**
     * Get customer group ids to which specified item is assigned
     *
     * @param int $id
     * @return mixed
     */
    public function lookupCustomerGroupIds($id)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getTable('salesrule_customer_group'), 'customer_group_id')
            ->where(
                'rule_id = :rule_id'
            );
        $binds = [':rule_id' => (int)$id];
        return $connection->fetchCol($select, $binds);
    }

    /**
     * lookup rule by sale rule id
     *
     * @param int $id
     * @return mixed
     */
    public function lookupRuleByid($id)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from(['tech9logyrule' => $this->getTable('tech9logy_couponcode_rule')])
            ->join(['salesrule' => $this->getTable('salesrule')], 'tech9logyrule.rule_id = salesrule.rule_id')
            ->where(
                'coupon_rule_id = :coupon_rule_id'
            )->limit(1);
        $binds = [':coupon_rule_id' => (int)$id];
        return $connection->fetchRow($select, $binds);
    }

    /**
     * lookup rule by id
     *
     * @param int $id
     * @return mixed
     */
    public function lookupSalesRule($id)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
                ->from(['tech9logyrule' =>$this->getTable('tech9logy_couponcode_rule')])
                ->join(['salesrule' => $this->getTable('salesrule')], 'tech9logyrule.rule_id = salesrule.rule_id')
                ->where(
                    'tech9logyrule.rule_id = :rule_id'
                )->limit(1);
        $binds = [':rule_id' => (int)$id];
        return $connection->fetchRow($select, $binds);
    }

    /**
     * get rule Data
     *
     * @return mixed
     */
    public function getRuleData()
    {
        $connection = $this->getConnection();
        $select = $connection->select()
                ->from(['tech9logyrule' =>$this->getTable('tech9logy_couponcode_rule')])
                ->join(['salesrule' => $this->getTable('salesrule')], 'tech9logyrule.rule_id = salesrule.rule_id');
        return $connection->fetchAll($select);
    }
}
