<?php

/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2024 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_Tathastu
 */

namespace Tech9logy\Tathastu\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Reports\Block\Product\Viewed;

class HomePage extends \Magento\Framework\View\Element\Template
{
    protected $_bestSellersCollectionFactory;
    protected $_productCollectionFactory;
    protected $_storeManager;

    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        StoreManagerInterface $storeManager,
        Viewed $recentlyViewed,
        BestSellersCollectionFactory $bestSellersCollectionFactory
    ) {
        $this->recentlyViewed = $recentlyViewed;
        $this->_bestSellersCollectionFactory = $bestSellersCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->_productCollectionFactory =  $productCollectionFactory;
        parent::__construct($context);
    }

    public function getBestSellerProductCollection()
    {
        $productIds = [];
        $bestSellers = $this->_bestSellersCollectionFactory->create()
            ->setPeriod('month');
        foreach ($bestSellers as $product) {
            $productIds[] = $product->getProductId();
        }
        $collection = $this->_productCollectionFactory->create()->addIdFilter($productIds);
        $collection->addMinimalPrice()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('visibility', 4)
            ->addStoreFilter($this->getStoreId())
            ->setPageSize(20);

        if ($collection->getSize() < 4) {
            $collection = $this->_productCollectionFactory->create()->addAttributeToSelect('*');
            $collection->addAttributeToSort('entity_id', 'asc')
                        ->addFieldToFilter('visibility', 4);
            $collection->addStoreFilter($this->getStoreId())->setPageSize(10);
        }
        return $collection;
    }

    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function getNewProductCollection()
    {
        $collection = $this->_productCollectionFactory->create()->addAttributeToSelect('*');
        $collection->addAttributeToSort('entity_id', 'desc')
                    ->addFieldToFilter('visibility', 4);
        $collection->addStoreFilter($this->getStoreId());
        $collection->setPageSize(20);
        return $collection;
    }

    public function getRecentViewedProductCollection()
    {
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $recentlyViewedClass = \Magento\Reports\Model\Product\Index\Viewed::class;
        $_recentlyViewedProductCollection = $_objectManager->create($recentlyViewedClass)->getCollection();
        $_recentlyViewedProductCollection->addAttributeToSelect('*')
                                        ->addFieldToFilter('visibility', 4)
                                        ->setPageSize(20)
                                        ->load();
        return $_recentlyViewedProductCollection;
    }
}
