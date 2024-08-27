<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Rule;

class Save extends \Tech9logy\CouponCode\Controller\Adminhtml\Rule
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $_dateFilter;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
    ) {
        parent::__construct($context, $coreRegistry);
        $this->_dateFilter = $dateFilter;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            try {
                /** @var $model \Magento\SalesRule\Model\Rule */
                $model = $this->_objectManager->create('Tech9logy\CouponCode\Model\Rule');
                $model_sale_rule = $this->_objectManager->create('Magento\SalesRule\Model\Rule');

                $id = $this->getRequest()->getParam('coupon_rule_id');

                if ($id) {
                    $model->load($id);
                    $sale_rule_id = $model->getRuleId();
                    $model_sale_rule->load($sale_rule_id);
                    if ($id != $model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong rule is specified.'));
                    }
                }

                $session = $this->_objectManager->get('Magento\Backend\Model\Session');

                $validateResult = $model_sale_rule->validateData(new \Magento\Framework\DataObject($data));
                if ($validateResult !== true) {
                    foreach ($validateResult as $errorMessage) {
                        $this->messageManager->addError($errorMessage);
                    }
                    $session->setPageData($data);
                    $this->_redirect('couponcode/*/edit', ['id' => $model->getId()]);
                    return;
                }

                if (isset($data['simple_action']) && $data['simple_action'] == 'by_percent' && isset($data['discount_amount'])) {
                    $data['discount_amount'] = min(100, $data['discount_amount']);
                }

                if (isset($data['rule']['conditions'])) {
                    $data['conditions'] = $data['rule']['conditions'];
                }
                if (isset($data['rule']['actions'])) {
                    $data['actions'] = $data['rule']['actions'];
                }
                if (empty($data['coupons_generated'])) {
                    $data['coupons_generated'] = 0;
                }
                $data['coupon_type'] = '2';
                $data['use_auto_generation'] = '1';

                $model_sale_rule->loadPost($data);
                $model->setData($data);
                $session->setPageData($model->getData());
                $model_sale_rule->save();
                $model->setData('rule_id', $model_sale_rule->getId());
                $model->setData('name', $model_sale_rule->getName());
                $model->save();
                $this->messageManager->addSuccess(__('You saved the Rule.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('couponcode/*/edit', ['coupon_rule_id' => $model->getId()]);
                    return;
                }
                $this->_redirect('couponcode/*/');
                return;

            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int) $this->getRequest()->getParam('coupon_rule_id');
                if (!empty($id)) {
                    $this->_redirect('couponcode/*/edit', ['coupon_rule_id' => $id]);
                } else {
                    $this->_redirect('couponcode/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Something went wrong while saving the rule data. Please review the error log.'));
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('couponcode/*/edit', ['coupon_rule_id' => $this->getRequest()->getParam('coupon_rule_id')]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tech9logy_CouponCode::rule_save');
    }
}
