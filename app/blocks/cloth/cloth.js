jQuery(document).ready(function () {
  jQuery('.product__cloth').on('click', function(){
    jQuery('.cloth').removeClass('hidden');
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-cloth.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#result-cloth').removeClass('hidden');
  });
  jQuery('.cloth__close').on('click', function(){
    price = "";
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('.cloth').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.cloth__close').click();
    }
  });
  jQuery('.product__cloth-add').on('click', function(){
    jQuery('.cloth').removeClass('hidden');
    jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-cloth-add.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#result-cloth').removeClass('hidden');
  });
  jQuery('.product__cloth-fix').on('click', function(){
    jQuery('#popup-fix img').attr('src',jQuery(this).attr('data-fix'));
    jQuery('#popup-fix').removeClass('hidden');
  });
  jQuery('#popup-fix .popup__content .listing__close').on('click', function(){
    jQuery('#popup-fix').addClass('hidden');
    jQuery('#popup-fix img').attr('src','');
  })
})