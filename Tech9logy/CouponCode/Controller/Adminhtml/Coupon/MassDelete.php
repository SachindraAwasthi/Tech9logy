<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Coupon;

use Magento\Framework\Controller\ResultFactory;
use Tech9logy\RewardPoints\Model\Earning;

class MassDelete extends \Tech9logy\CouponCode\Controller\Adminhtml\Coupon
{
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;

    /**
     * @var \Tech9logy\CouponCode\Model\ResourceModel\Coupon\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context                             $context
     * @param \Magento\Ui\Component\MassAction\Filter                         $filter
     * @param \Tech9logy\CouponCode\Model\ResourceModel\Coupon\CollectionFactory    $collectionFactory
     * @param  \Magento\Framework\Registry                                    $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Tech9logy\CouponCode\Model\ResourceModel\Coupon\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
         parent::__construct($context, $coreRegistry);
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
            $collection = $this->collectionFactory->create()->addFieldToFilter('couponcode_id', ['in' => $data['selected']]);
        }
        foreach ($collection as $rule) {
            $couponcode_id = $rule->getCouponId();
            $rule->delete();
            if ($couponcode_id) {
                $model_sale_coupon = $this->_objectManager->create('Magento\SalesRule\Model\Coupon');
                $model_sale_coupon->load($couponcode_id);
                $model_sale_coupon->delete();
            }
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
        return $this->_authorization->isAllowed('Tech9logy_CouponCode::coupon_delete');
    }
}
