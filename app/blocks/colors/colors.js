jQuery(document).ready(function () {
  jQuery('#product__colors').on('click', function(){
    jQuery('.colors').removeClass('hidden');
    var str = jQuery("#product-colors").serialize();
    jQuery("#result-colors").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-colors.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-colors").html(data);
        }
    });
    jQuery('#result-colors').removeClass('hidden');
  });
  jQuery('.colors__close').on('click', function(){
    jQuery('.colors').addClass('hidden');
    jQuery('#result-colors').addClass('hidden');
  });
})