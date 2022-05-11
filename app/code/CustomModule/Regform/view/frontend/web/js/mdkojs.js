define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    return Component.extend({
    defaults: {
    template: 'CustomModule_Regform/knockout-test-example'
    },
    initialize: function () {
    this._super();
    }
    });
    }
    );