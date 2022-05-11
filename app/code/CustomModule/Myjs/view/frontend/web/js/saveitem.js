define([
    "jquery",
    "jquery/ui"
], function($){
    'use strict';  
    alert('hii');
    $('#demosubmit').on('click', function(e) {
        var formdata = new FormData(jQuery('#demoform')[0]);
     //   formdata.append('file',document.getElementById("image_upload").files[0]);
     alert('hello');
            $.ajax({
            url:  'http://agri.epayerz.local/humanitarian/customjs/index/save',
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formdata,
            showLoader: true,
            success: function(data) {
              console.log(data.json);
            }
        });
    
       e.preventDefault();
    
    
    });
});