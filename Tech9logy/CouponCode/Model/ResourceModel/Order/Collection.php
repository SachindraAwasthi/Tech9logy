<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model\ResourceModel\Order;

class Collection extends \Tech9logy\CouponCode\Model\ResourceModel\AbstractReport\Ordercollection
{
    /** @var bool */
    protected $_isLive = false;

    /** @var string */
    protected $_date_column_filter;

    /**
     * Set the date column filter
     *
     * @param string $column_name
     * @return $this
     */
    public function setDateColumnFilter($column_name = '')
    {
        if ($column_name) {
            $this->_date_column_filter = $column_name;
        }
        return $this;
    }

    /**
     * Get the date column filter
     *
     * @return string
     */
    public function getDateColumnFilter()
    {
        return $this->_date_column_filter;
    }

    /**
     * Add a date filter from
     *
     * @param null $from
     * @return $this
     */
    public function addDateFromFilter($from = null)
    {
        $this->_from_date_filter = $from;
        return $this;
    }

    /**
     * Add a date filter to
     *
     * @param null $to
     * @return $this
     */
    public function addDateToFilter($to = null)
    {
        $this->_to_date_filter = $to;
        return $this;
    }

    /**
     * Set the period type
     *
     * @param string $period_type
     * @return $this
     */
    public function setPeriodType($period_type = "")
    {
        $this->_period_type = $period_type;
        return $this;
    }

    /**
     * Add a product ID filter
     *
     * @param int $product_id
     * @return $this
     */
    public function addProductIdFilter($product_id = 0)
    {
        $this->_product_id_filter = $product_id;
        return $this;
    }

    /**
     * Add a product SKU filter
     *
     * @param string $product_sku
     * @return $this
     */
    public function addProductSkuFilter($product_sku = "")
    {
        $this->_product_sku_filter = $product_sku;
        return $this;
    }

    /**
     * Apply the date filter
     *
     * @return $this
     */
    protected function _applyDateFilter()
    {
        $select_datefield = [];
        if ($this->_period_type) {
            switch ($this->_period_type) {
                case "year":
                    $select_datefield = [
                        'period' => 'YEAR(' . $this->getDateColumnFilter() . ')',
                    ];
                    break;
                case "quarter":
                    $select_datefield = [
                        'period' => 'CONCAT(QUARTER(' . $this->getDateColumnFilter() . '), "/", YEAR(' . $this->getDateColumnFilter() . '))',
                    ];
                    break;
                case "week":
                    $select_datefield = [
                        'period' => 'CONCAT(YEAR(' . $this->getDateColumnFilter() . '), "", WEEK(' . $this->getDateColumnFilter() . '))',
                    ];
                    break;
                case "day":
                    $select_datefield = [
                        'period' => 'DATE(' . $this->getDateColumnFilter() . ')',
                    ];
                    break;
                case "hour":
                    $select_datefield = [
                        'period' => "DATE_FORMAT(" . $this->getDateColumnFilter() . ", '%H:00')",
                    ];
                    break;
                case "weekday":
                    $select_datefield = [
                        'period' => 'WEEKDAY(' . $this->getDateColumnFilter() . ')',
                    ];
                    break;
                case "month":
                default:
                    $select_datefield = [
                        'period' => 'CONCAT(MONTH(' . $this->getDateColumnFilter() . '), "/", YEAR(' . $this->getDateColumnFilter() . '))',
                        'period_sort' => 'CONCAT(MONTH(' . $this->getDateColumnFilter() . '),"",YEAR(' . $this->getDateColumnFilter() . '))',
                    ];
                    break;
            }
        }
        if ($select_datefield) {
            $this->getSelect()->columns($select_datefield);
        }

        if ($this->_to_date_filter && $this->_from_date_filter) {
            $dateStart = $this->_localeDate->convertConfigTimeToUtc($this->_from_date_filter, 'Y-m-d 00:00:00');
            $endStart = $this->_localeDate->convertConfigTimeToUtc($this->_to_date_filter, 'Y-m-d 23:59:59');
            $dateRange = [
                'from' => $dateStart,
                'to' => $endStart,
            ];
        }
        if ($dateRange) {
            $this->addFieldToFilter('period', ['from' => $dateRange['from'], 'to' => $dateRange['to']]);
        }
        return $this;
    }
}
