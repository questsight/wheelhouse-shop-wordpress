jQuery(document).ready(function () {
  jQuery('#pa_size-krd').change(function() {
    jQuery('[name="mattress-size"]').attr('value',jQuery(this).val());
    if(jQuery('#product__mattress').attr('data-fix')){
      jQuery('#product__mattress').html('Выбрать матрас');
    }else{
      jQuery('#product__mattress').html('Добавить матрас');
    }
    jQuery('#product__namatrasniki').html('Добавить наматрасник');
    jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    jQuery('#product__pokryvala').html('Добавить покрывало');
    jQuery('#add-mattress').removeAttr('name');
    jQuery('#add-namatrasniki').removeAttr('name');
    jQuery('#add-chehly-na-matras').removeAttr('name');
    jQuery('#add-pokryvala').removeAttr('name');
    jQuery('#add-mattress').removeAttr('value');
    jQuery('#add-namatrasniki').removeAttr('value');
    jQuery('#add-chehly-na-matras').removeAttr('value');
    jQuery('#add-pokryvala').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-matrasy');
    jQuery('.variation_id').removeAttr('data-namatrasniki');
    jQuery('.variation_id').removeAttr('data-chehly-na-matras');
    jQuery('.variation_id').removeAttr('data-pokryvala');
  });
  jQuery('#pa_kategoriya-tkani').change(function() {
    jQuery('[name="mattress-size"]').attr('value',jQuery(this).val());
    jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    jQuery('#product__pokryvala').html('Добавить покрывало');
    jQuery('#add-chehly-na-matras').removeAttr('name');
    jQuery('#add-pokryvala').removeAttr('name');
    jQuery('#add-chehly-na-matras').removeAttr('value');
    jQuery('#add-pokryvala').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-chehly-na-matras');
    jQuery('.variation_id').removeAttr('data-pokryvala');
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
  jQuery('#product__namatrasniki').on('click', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-namatrasniki.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__chehly-na-matras').on('click', function(){
    jQuery('.mattress').removeClass('hidden');
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-chehly-na-matras.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__pokryvala').on('click', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-pokryvala.php',
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