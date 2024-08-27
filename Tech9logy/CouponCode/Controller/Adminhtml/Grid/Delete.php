<?php

namespace Tech9logy\CouponCode\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;

use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    /**

     * @var \Tech9logy\CouponCode\Model\CampaignsFactory

     */

    protected $campaignsFactory;

    /**

     * @param Context                    $context

     * @param \Tech9logy\CouponCode\Model\CampaignsFactory $campaignsFactory

     */

    public function __construct(
        Context $context,
        \Tech9logy\CouponCode\Model\CampaignsFactory $campaignsFactory
    ) {
        parent::__construct($context);

        $this->campaignsFactory = $campaignsFactory;
    }

    /**

     * @return bool

     */

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("Tech9logy_CouponCode::view");
    }

    /**

     * @return \Magento\Backend\Model\View\Result\Redirect

     */

    public function execute()
    {
        $id = $this->getRequest()->getParam("id");

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $model = $this->campaignsFactory->create();

                $model->load($id);

                $model->delete();

                $this->messageManager->addSuccess(
                    __("The post has been deleted.")
                );

                return $resultRedirect->setPath("*/*/");
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());

                return $resultRedirect->setPath("*/*/index", ["id" => $id]);
            }
        }

        $this->messageManager->addError(__('We can\'t find a post to delete.'));

        return $resultRedirect->setPath("*/*/");
    }
}
