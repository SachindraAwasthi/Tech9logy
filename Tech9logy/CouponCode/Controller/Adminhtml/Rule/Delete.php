<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Controller\Adminhtml\Rule;

class Delete extends \Tech9logy\CouponCode\Controller\Adminhtml\Rule
{
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tech9logy_CouponCode::rule_delete');
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('rule_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Tech9logy\CouponCode\Model\Rule');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the rule.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['rule_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a rule to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
