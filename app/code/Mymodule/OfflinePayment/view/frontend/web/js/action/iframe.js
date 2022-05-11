define(
    [
        
        'jquery',
        'Magento_Checkout/js/model/quote'

       
    ],
    function ($,quote) {
        'use strict';
        return function (messageContainer) {
            $( "#inlineFrameExample" ).dialog({
                resizable: false,
                modal: true,
                height: 500,
                button:{
                    "Close": function() {
                        $(this).dialog( "close" );
                    }
                }
               
                });
           
        };
    }
);