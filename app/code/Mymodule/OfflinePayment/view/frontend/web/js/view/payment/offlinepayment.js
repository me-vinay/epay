define(
    [
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
    Component,
    rendererList
    ) {
    'use strict';
    rendererList.push(
    {
    type: 'offlinepayment',
    component: 'Mymodule_OfflinePayment/js/view/payment/method-renderer/simple-method'
    }
    );
    /** Add view logic here if needed */
    return Component.extend({});
    }
    );