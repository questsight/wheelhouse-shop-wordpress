jQuery(document).ready(function () {
  jQuery('.product__pillar').on('click touchend', function(){
    jQuery('.pillar').removeClass('hidden');
    var str = jQuery("#product-pillar").serialize();
    jQuery("#result-pillar").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-pillar.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-pillar").html(data);
        }
    });
    jQuery('#result-pillar').removeClass('hidden');
  });
  jQuery('.pillar__close').on('click', function(){
    jQuery('#result-pillar').addClass('hidden');
    jQuery('.pillar').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.pillar__close').click();
    }
  });
})