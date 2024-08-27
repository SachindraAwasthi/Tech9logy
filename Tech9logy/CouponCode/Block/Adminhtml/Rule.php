<?php
 
namespace Tech9logy\CouponCode\Block\Adminhtml;

class Rule extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @var \Magento\FollowUpEmail\Model\EmailFactory
     */
    protected $_couponFactory;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\FollowUpEmail\Model\Email\TypeFactory $typeFactory
     * @param \Magento\FollowUpEmail\Model\EmailFactory $emailFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Tech9logy\CouponCode\Model\CouponFactory $couponFactory,
        array $data = []
    ) {
        $this->_emailFactory = $couponFactory;

        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \Tech9logy\FollowUpEmail\Block\Adminhtml\Email
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new_rule',
            'label' => __('Create New Rule'),
            'class' => 'add',
            'button_class' => '',
            'class_name' => 'Magento\Backend\Block\Widget\Button\SplitButton',
            'options' => $this->getEventTypes(),
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }

    /**
     * Retrieve options for 'Add Email' split button
     *
     * @return mixed
     */

    /**
     * Check whether it is single store mode
     *
     * @return bool
     */
    public function isSingleStoreMode()
    {
        return $this->_storeManager->isSingleStoreMode();
    }
}
