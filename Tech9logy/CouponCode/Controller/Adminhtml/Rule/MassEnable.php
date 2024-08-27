<?php
 /**
  * @author Sachindra Awasthi
  * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
  * @package Tech9logy_CouponCode
  */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Rule;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Tech9logy\CouponCode\Model\ResourceModel\Rule\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class MassDisable
 */
class MassEnable extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $data = $this->getRequest()->getParams();
        if (isset($data['selected'])) {
            $collection = $this->collectionFactory->create()->addFieldToFilter('coupon_rule_id', ['in' => $data['selected']]);
        }
        foreach ($collection as $item) {
            $item->setData('is_active', '1');
            $item->save();
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been enabled.', $collection->getSize()));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
