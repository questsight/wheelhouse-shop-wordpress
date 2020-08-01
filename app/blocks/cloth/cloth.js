jQuery(document).ready(function () {
  jQuery('.product__cloth').on('click', function(){
    jQuery('.cloth').removeClass('hidden');
  });
  jQuery('.cloth__color').on('click', function(){
    jQuery('[data-marker]').attr('value',jQuery(this).attr('data-color'));
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div style="text-align:center; padding:30px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
    jQuery.ajax({
        url: 'https://wheelhousedesign.ru/wp-content/themes/questsight/ajax-cloth.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#cloth__color').addClass('hidden');
    jQuery('#result-cloth').removeClass('hidden');
  });
  jQuery('.cloth__close').on('click', function(){
    price = "";
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('#cloth__color').removeClass('hidden');
    jQuery('.cloth').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.cloth__close').click();
    }
  });
  jQuery('.product__cloth-add').on('click', function(){
    jQuery('#cloth__color').addClass('hidden');
    jQuery('.cloth').removeClass('hidden');
    jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div style="text-align:center; padding:30px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
    jQuery.ajax({
        url: 'https://wheelhousedesign.ru/wp-content/themes/questsight/ajax-cloth-add.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#result-cloth').removeClass('hidden');
  });
})