define(
    [
        'ko',
        'jquery',
        'Magento_Checkout/js/view/payment/default',
        'Mymodule_OfflinePayment/js/action/set-payment-method-action',
        'Mymodule_OfflinePayment/js/action/iframe',

    ],
    function (ko, $, Component, setPaymentMethodAction,iframe) {
    'use strict';
    return Component.extend({
    defaults: {
         redirectAfterPlaceOrder: false,
         iframe: false,
        template: 'Mymodule_OfflinePayment/payment/simple'
    },

    
//Below logic is to redirect custom controller
   /** afterPlaceOrder: function () {
    setPaymentMethodAction(this.messageContainer);
      return false;
    },*/


    afterPlaceOrder: function(){
        iframe(this.messageContainer);
        return false;
       
    },
    
    /** Returns send check to info */
    getMailingAddress: function() {
    return window.checkoutConfig.payment.invoice30.mailingAddress;
    },
    /** Returns payable to info */
    /*getPayableTo: function() {
    return window.checkoutConfig.payment.checkmo.payableTo;
    }*/
    });
    }
    );