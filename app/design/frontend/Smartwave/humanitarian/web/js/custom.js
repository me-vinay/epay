require(['jquery', 'jquery/ui'], function($){
  jQuery(document).ready( function() {
  	jQuery(".donate-popup").click(function(){
                $('body').css('overflow','hidden');
                //jQuery(".content-box").show();
                //if($("response-msg").length){
                  jQuery(".donation-input").val('');
                  jQuery(".response-msg").remove();
                //}
                if($(".inactive").length){
                  $(".donate-now").removeClass('inactive');
                }
                jQuery(".pre").html('');
                $(this).addClass('active');
                var imgPath = $(this).attr('data-img');
                var sku = $(this).attr('data-sku');
                var name = $(this).attr('data-name');
                var description = $(this).attr('data-description');
                var qty = $(this).attr('data-qty');
                var id = $(this).attr('data-id');
                jQuery(".donation-box img").attr('src',imgPath);
                jQuery(".description").append('<span> Description: '+description+'</span>');
                jQuery(".qty-needed").append('<span> Quantity Needed: '+qty+'</span>');
                jQuery(".product-name").append('<span> Name: '+name+'</span>');
                jQuery("#sku-hidden").val(sku);
                jQuery("#id-hidden").val(id);
  		jQuery('.donation-popup-container').css({"display": "block","position": "absolute","width": "100%","height": "100%","background": "#00000030","top": "0px","left": "0","bottom": "0", "right": "0","z-index": "11"});
  	});
  	jQuery(".donation-popup-container-close").click(function(){
  		jQuery('.donation-popup-container').hide();
  	});
  	jQuery(".donate-now").click(function(){
              if(!$(".inactive").length){
                $(".donate-now").addClass('inactive');
                   var productId = $("#id-hidden").val();
                   var email = $("#donation-email").val();
                   var sku = $('#sku-hidden').val();
                   var donatedBy = $("#donation-donated-by").val();
                   var address = $("#donation-address").val();
                   var postcode = $("#donation-postcode").val();
                   var donatedType = $("#donation-donated-type").val();
                   var description = $("#donation-description").val();
                   var qty = $("#donation-qty").val();
                   var phone = $("#donation-phone").val();
                   var country = $('select[name=country] option').filter(':selected').val();
                   var city = $("#donation-city").val();
      	$.ajax({
    	      type: "POST",
    	      url: "http://agri.epayerz.local/humanitarian/human/index/donate",
    	      data: {'product_id':productId, 'product_sku':sku,'description':description, 'donated_by':donatedBy,'address':address,'donor_type':donatedType,'qty':qty,'phone_number':phone,'email':email, 'post_code':postcode, 'country_id':country, "city":city},
         
    	     success: function(response){
                    $(".donate-now").addClass('inactive');
                    // jQuery(".content-box").hide();
                    alert(response.status);
                    jQuery(".donation-box").prepend("<div class='response-msg' style='color:green'>"+response.status+"</div>");
    	               $('body').css('overflow','scroll');
                     setTimeout(function() {
                      jQuery('.donation-popup-container').hide();
                    }, 1000);

                     j
           }
    	    });
      }

	    return false;
 	});
   });
});