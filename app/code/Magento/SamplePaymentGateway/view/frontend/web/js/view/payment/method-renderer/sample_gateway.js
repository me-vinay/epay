/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define([
  "Magento_Checkout/js/view/payment/default",
  "Magento_Checkout/js/model/totals",
  "jquery",
  "ko",
  "Magento_Checkout/js/model/payment/additional-validators",
  "Magento_Checkout/js/action/redirect-on-success",
], function (
  Component,
  totals,
  $,
  ko,
  additionalValidators,
  redirectOnSuccessAction
) {
  "use strict";

  return Component.extend({
    defaults: {
      template: "Magento_SamplePaymentGateway/payment/form",
      transactionResult: "",
    },

    initObservable: function () {
      this._super().observe(["transactionResult"]);
      return this;
    },

    getCode: function () {
      return "sample_gateway";
    },
    getData: function () {
      return {
        method: this.item.method,
        additional_data: {
          transaction_result: this.transactionResult(),
        },
      };
    },
    vendorData: function () {
      var baseShippingPrice = "";
      if (totals.totals()) {
        var baseShippingPrice = parseFloat(
          totals.totals()["base_shipping_amount"]
        );
      }
      var vendorData = window.checkoutConfig.custom_data;
      var shippingWallet = {
        vendorEmail: "epayerzshipping@gmail.com",
        amount: baseShippingPrice,
      };
      vendorData.push(shippingWallet);
      return vendorData;
    },
    walletLogin: function () {
      event.preventDefault();
      var status = 0;

      var vendorDataArray = this.vendorData();

      var userid = $("#walletuser").val();
      var password = $("#walletpassword").val();
      if (userid && password && this.validateOrder()) {
        $(".rspns-msg").html();
        var data = {
          customerEmail: userid,
          password: password,
          vendorUserIdAndAmount: vendorDataArray,
        };
        var result = JSON.stringify(data);
        $.ajax({
          type: "POST",
          url: "https://web.epayerz.com/WalletTransaction/CheckWalletAndUpdateWallet",
          dataType: "json",
          contentType: "application/json",
          data: result,
          async: false,
          error: function (e) {
            $(".rspns-msg").html(e.responseJSON.message);
            $(".rspns-msg").css("color", "red");
            status = 0;
          },
          success: function (e) {
            $(".rspns-msg").html(e.message);
            $(".rspns-msg").css("color", "green");
            status = 200;
          },
        });
      } else {
        if (userid && password) {
          $(".rspns-msg").html("");
        } else {
          $(".rspns-msg").html("please fill the details.");
          $(".rspns-msg").css("color", "red");
        }
      }
      if (status == 200) {
        this.placeOrder();
      } else {
        this.validateOrder();
      }
    },
    validateOrder: function (data, event) {
      var self = this;

      if (event) {
        event.preventDefault();
      }

      if (
        this.validate() &&
        additionalValidators.validate() &&
        this.isPlaceOrderActionAllowed() === true
      ) {
        this.isPlaceOrderActionAllowed(true);

        return true;
      }

      return false;
    },
    placeOrder: function (data, event) {
      var self = this;

      if (event) {
        event.preventDefault();
      }

      if (
        this.validate() &&
        additionalValidators.validate() &&
        this.isPlaceOrderActionAllowed() === true
      ) {
        this.isPlaceOrderActionAllowed(false);
        this.getPlaceOrderDeferredObject()
          .done(function () {
            self.afterPlaceOrder();

            if (self.redirectAfterPlaceOrder) {
              redirectOnSuccessAction.execute();
            }
          })
          .always(function () {
            self.isPlaceOrderActionAllowed(true);
          });

        return true;
      }

      return false;
    },

    getTransactionResults: function () {
      return _.map(
        window.checkoutConfig.payment.sample_gateway.transactionResults,
        function (value, key) {
          return {
            value: key,
            transaction_result: value,
          };
        }
      );
    },
  });
});
