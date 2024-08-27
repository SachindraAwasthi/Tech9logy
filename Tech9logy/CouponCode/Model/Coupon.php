<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Model;

use Tech9logy\CouponCode\Api\Data\CouponInterface;

class Coupon extends \Magento\Framework\Model\AbstractModel implements CouponInterface
{
    /**
     * Blog's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;



    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $_storeManager;

    /**
     * URL Model instance
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;

    protected $_resource;

    protected $_couponCollection;
    /**
     * Page cache tag
     */
    /**
     * @param \Magento\Framework\Model\Context                          $context
     * @param \Magento\Framework\Registry                               $registry
     * @param \Tech9logy\CouponCode\Model\ResourceModel\Coupon|null                $resource
     * @param \Tech9logy\CouponCode\Model\ResourceModel\Coupon\Collection|null $resourceCollection
     * @param \Tech9logy\CouponCode\Model\ResourceModel\Coupon\CollectionFactory|null $couponCollection
     * @param \Magento\Store\Model\StoreManagerInterface                $storeManager
     * @param \Magento\Framework\UrlInterface                           $url
     * @param array                                                     $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Tech9logy\CouponCode\Model\ResourceModel\Coupon $resource = null,
        \Tech9logy\CouponCode\Model\ResourceModel\Coupon\Collection $resourceCollection = null,
        \Tech9logy\CouponCode\Model\ResourceModel\Coupon\CollectionFactory $couponCollection,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $url,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_url = $url;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->_resource = $resource;
        $this->_couponCollection = $couponCollection;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('\Tech9logy\CouponCode\Model\ResourceModel\Coupon');
    }

    /**
     * Load object data
     * @param string $alias
     * @return $this
     */
    public function getCouponByAlias($alias)
    {
        $this->_beforeLoad($alias, 'alias');
        $this->_getResource()->load($this, $alias, 'alias');
        $this->_afterLoad();
        $this->setOrigData();
        $this->_hasDataChanges = false;
        return $this;
    }

    /**
     * Load object data by code
     * @param string $couponCode
     * @return $this
     */
    public function getCouponByCode($couponCode)
    {
        $this->_beforeLoad($couponCode, 'code');
        $this->_getResource()->load($this, $couponCode, 'code');
        $this->_afterLoad();
        $this->setOrigData();
        $this->_hasDataChanges = false;
        return $this;
    }

    /**
     * Get coupon_id
     * @return string
     */
    public function getCouponId()
    {
        return $this->getData(self::COUPON_ID);
    }

    /**
     * Set coupon_id
     * @param string $couponId
     * @return \Tech9logy\CouponCode\Api\Data\CouponInterface
     */
    public function setCouponId($couponId)
    {
        return $this->setData(self::COUPON_ID, $couponId);
    }

    /**
     * Get couponcode_id
     * @return string
     */
    public function getCouponcodeId()
    {
        return $this->getData(self::COUPONCODE_ID);
    }

    /**
     * Set couponcode_id
     * @param string $couponcode_id
     * @return \Tech9logy\CouponCode\Api\Data\CouponInterface
     */
    public function setCouponcodeId($couponcode_id)
    {
        return $this->setData(self::COUPONCODE_ID, $couponcode_id);
    }
}
