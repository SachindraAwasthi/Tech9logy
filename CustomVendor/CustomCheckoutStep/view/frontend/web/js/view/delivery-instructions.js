define([
    'uiComponent',
    'Magento_Checkout/js/model/step-navigator'
], function (Component, stepNavigator) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'CustomVendor_CustomCheckoutStep/delivery-instructions'
        },

        isVisible: ko.observable(true),

        initialize: function () {
            this._super();
            stepNavigator.registerStep(
                'delivery-instructions',
                null,
                'Delivery Instructions',
                this.isVisible,
                _.bind(this.navigate, this),
                10
            );

            return this;
        },

        navigate: function () {
        }
    });
});
