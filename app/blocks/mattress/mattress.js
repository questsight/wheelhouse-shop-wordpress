jQuery(document).ready(function () {
  jQuery('#pa_size-krd').change(function() {
    jQuery('[name="mattress-size"]').attr('value',jQuery(this).val());
    if(jQuery('#product__mattress').attr('data-fix')){
      jQuery('#product__mattress').html('Выбрать матрас');
    }else{
      jQuery('#product__mattress').html('Добавить матрас');
    }
    jQuery('#product__mattress-above').html('Добавить наматрасник');
    jQuery('#add-mattress').removeAttr('name');
    jQuery('#add-mattress-above').removeAttr('name');
    jQuery('#add-mattress').removeAttr('value');
    jQuery('#add-mattress-above').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-addprice');
    jQuery('.variation_id').removeAttr('data-addpricetwo');
  });
  jQuery('.variation_id').change( function(){
    jQuery('[name="mattress-size"]').attr('value',jQuery('#pa_size-krd').val());
  });
  jQuery('#product__mattress').on('click', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-mattress.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__mattress-above').on('click', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-mattress-above.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('.mattress__close').on('click', function(){
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-mattress').addClass('hidden');
    jQuery('.mattress').addClass('hidden');
  });
})