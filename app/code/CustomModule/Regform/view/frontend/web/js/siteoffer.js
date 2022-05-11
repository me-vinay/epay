define([
    "jquery",
    "jquery/ui"
], function($,){
    'use strict';  
    return function (config, element) {
        var shippingoffer = config.shippingoffer;
        var couponoffer = config.couponoffer
        $(".siteoffer span").text(shippingoffer);
        setInterval(function() {
                if( $(".siteoffer span").text()!=couponoffer){
                    $(".siteoffer span").text(couponoffer).fadeToggle(2000);
                }else{
                    $(".siteoffer span").text(shippingoffer).fadeToggle(2000);
                }
        }, 2000);
       }
});