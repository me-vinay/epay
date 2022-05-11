define([
    "jquery",
    "jquery/ui"
], function($){
    'use strict';  
    $('#proform').on('submit', function(e) {
        var url = $('#product_create_form').attr('action');
        var formdata = new FormData(jQuery('#product_create_form')[0]);
     //   formdata.append('file',document.getElementById("image_upload").files[0]);
  
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formdata,
            showLoader: true,
            success: function() {
              console.log('Data has been saved');
            }
        });
    
       e.preventDefault();
    
    
    });
});