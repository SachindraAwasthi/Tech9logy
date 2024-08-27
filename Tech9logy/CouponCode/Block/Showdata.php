<?php

namespace Tech9logy\CouponCode\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Tech9logy\CouponCode\Model\ResourceModel\Campaigns\CollectionFactory;
use Tech9logy\CouponCode\Model\ResourceModel\Campaigns\CollectionFactory as CampaignsCollectionFactory;

class Showdata extends Template
{

    public $collection;
    protected $campaignsCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        CampaignsCollectionFactory $campaignsCollectionFactory,
        array $data = []
    ) {
        $this->collection = $collectionFactory;
        $this->campaignsCollectionFactory = $campaignsCollectionFactory;
        parent::__construct($context, $data);
    }
    public function getDetails()
    {
        $campaignCollection = $this->campaignsCollectionFactory->create();
        return $this->campaignsCollectionFactory->create();
    }
    public function getCollection()
    {
        return $this->collection->create();
    }
}
