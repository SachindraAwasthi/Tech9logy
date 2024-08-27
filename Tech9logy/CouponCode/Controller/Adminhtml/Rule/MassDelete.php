<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Rule;

use Magento\Framework\Controller\ResultFactory;
use Tech9logy\RewardPoints\Model\Earning;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;

    /**
     * @var \Tech9logy\CouponCode\Model\ResourceModel\Rule\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context                             $context
     * @param \Magento\Ui\Component\MassAction\Filter                         $filter
     * @param \Tech9logy\RewardPoints\Model\ResourceModel\Earning\CollectionFactory $collectionFactory
     * @param \Tech9logy\RewardPoints\Helper\Data                                   $rewardsData
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Tech9logy\CouponCode\Model\ResourceModel\Rule\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->filter             = $filter;
        $this->collectionFactory  = $collectionFactory;
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
        foreach ($collection as $rule) {
                $rule->delete();
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collection->count()));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tech9logy_CouponCode::rule_delete');
    }
}
