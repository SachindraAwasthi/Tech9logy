<?php
/**
 * @author Sachindra Awasthi
 * @copyright Copyright (c) 2023 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_CouponCode
 */
namespace Tech9logy\CouponCode\Block\Adminhtml\Coupon\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create([
            "data" => [
                "id" => "edit_form",
                "action" => $this->getData("action"),
                "method" => "post",
            ],
        ]);
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
