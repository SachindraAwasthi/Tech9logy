<?php
/**
 * @package Tech9logy_CouponCode
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 */

namespace Tech9logy\CouponCode\Model\ResourceModel\AbstractReport;

use Magento\Framework\DB\Select;

class Ordercollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_main_table_id = 'main_table.entity_id';
    protected $_status_field = 'main_table.status';
    protected $_storesIds = 0;
    protected $_period_type = '';
    protected $_isLive = false;
    protected $_aggregatedColumns = [];
    protected $_salesAmountExpression;
    protected $_isTotals = false;
    protected $_isSubTotals = false;
    protected $_year_filter = '';
    protected $_month_filter = '';
    protected $_day_filter = '';
    protected $_orderStatus = '';
    protected $_to_date_filter = '';
    protected $_from_date_filter = '';
    protected $_objectManager;
    protected $_scopeConfig;
    protected $_registry;
    protected $_storeManager;
    protected $_localeDate;
    protected $customerResource;

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Customer\Model\ResourceModel\Customer $customerResource,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager);
        $this->_objectManager = $objectManager;
        $this->_scopeConfig = $scopeConfig;
        $this->_registry = $registry;
        $this->_localeDate = $localeDate;
        $this->_storeManager = $storeManager;
        $this->customerResource = $customerResource;
    }

    protected function _construct()
    {
        $this->_init('\Magento\Sales\Model\Order', '\Magento\Sales\Model\ResourceModel\Order\Collection');
    }

    public function setMainTableId($id = "")
    {
        if ($id) {
            $this->_main_table_id = $id;
        }
        return $this;
    }

    // Other methods...

    public function applyCustomFilter()
    {
        return $this;
    }

    public function getArrayItems($column_name = "")
    {
        $items = [];
        foreach ($this as $item) {
            $key_value = $item->getData($column_name);
            if ($key_value !== null && $key_value !== false) {
                $items[$key_value] = $item;
            }
        }
        return $items;
    }
}
