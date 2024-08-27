<?php

namespace CustomVendor\CustomCheckoutStep\Block\Checkout;

class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{
    public function process($jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['delivery-instructions'] = [
            'component' => 'CustomVendor_CustomCheckoutStep/js/view/delivery-instructions',
            'sortOrder' => 1,
            'children' => [
                'delivery-instructions-field' => [
                    'component' => 'Magento_Ui/js/form/element/textarea',
                    'config' => [
                        'customScope' => 'customcheckoutstep',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/textarea',
                        'id' => 'delivery_instructions'
                    ],
                    'dataScope' => 'customcheckoutstep.delivery_instructions',
                    'label' => __('Delivery Instructions'),
                    'provider' => 'checkoutProvider',
                    'visible' => true,
                    'validation' => [
                        'required-entry' => true
                    ],
                    'sortOrder' => 1,
                    'id' => 'delivery_instructions'
                ]
            ]
        ];

        return $jsLayout;
    }
}
