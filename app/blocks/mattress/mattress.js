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
    jQuery('#product__mattress').parent('.product__variation').removeClass('choice');
    jQuery('#product__mattress').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__namatrasniki').parent('.product__variation').removeClass('choice');
    jQuery('#product__namatrasniki').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__chehly-na-matras').parent('.product__variation').removeClass('choice');
    jQuery('#product__chehly-na-matras').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__pokryvala').parent('.product__variation').removeClass('choice');
    jQuery('#product__pokryvala').parent('.product__variation').children('.product__delete').addClass('hidden');
    //jQuery('#product__podushki').html('Добавить подушки');
    jQuery('#add-mattress').removeAttr('name');
    jQuery('#add-namatrasniki').removeAttr('name');
    jQuery('#add-chehly-na-matras').removeAttr('name');
    jQuery('#add-pokryvala').removeAttr('name');
    //jQuery('#add-podushki').removeAttr('name');
    jQuery('#add-mattress').removeAttr('value');
    jQuery('#add-namatrasniki').removeAttr('value');
    jQuery('#add-chehly-na-matras').removeAttr('value');
    jQuery('#add-pokryvala').removeAttr('value');
    //jQuery('#add-podushki').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-mattress');
    jQuery('.variation_id').removeAttr('data-namatrasniki');
    jQuery('.variation_id').removeAttr('data-chehly-na-matras');
    jQuery('.variation_id').removeAttr('data-pokryvala');
    //jQuery('.variation_id').removeAttr('data-podushki');
  });
  jQuery('#pa_kategoriya-tkani').change(function() {
    jQuery('[name="mattress-size"]').attr('value',jQuery(this).val());
    jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    jQuery('#product__pokryvala').html('Добавить покрывало');
    jQuery('#product__podushki').html('Добавить подушки');
    jQuery('#product__chehly-na-matras').parent('.product__variation').removeClass('choice');
    jQuery('#product__chehly-na-matras').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__pokryvala').parent('.product__variation').removeClass('choice');
    jQuery('#product__pokryvala').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__chehly-na-matras').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__podushki').parent('.product__variation').removeClass('choice');
    jQuery('#product__podushki').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#add-chehly-na-matras').removeAttr('name');
    jQuery('#add-pokryvala').removeAttr('name');
    jQuery('#add-podushki').removeAttr('name');
    jQuery('#add-chehly-na-matras').removeAttr('value');
    jQuery('#add-pokryvala').removeAttr('value');
    jQuery('#add-podushki').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-chehly-na-matras');
    jQuery('.variation_id').removeAttr('data-pokryvala');
    jQuery('.variation_id').removeAttr('data-podushki');
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
  jQuery('#product__podushki').on('click', function(){
    jQuery('.mattress').removeClass('hidden');
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-podushki.php',
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
  jQuery('.product__delete').on('click', function(){
    var cat = jQuery(this).attr("id").replace('del-', '');
    if(cat=='mattress'){
      if(jQuery('#product__mattress').attr('data-fix')){
        jQuery('#product__mattress').html('Выбрать матрас');
      }else{
        jQuery('#product__mattress').html('Добавить матрас');
      }
    }else if (cat=='namatrasniki') {
      jQuery('#product__namatrasniki').html('Добавить наматрасник');
    }else if (cat=='chehly-na-matras') {
      jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    }else if (cat=='pokryvala') {
      jQuery('#product__pokryvala').html('Добавить покрывало');
    }else if (cat=='podushki') {
      jQuery('#product__podushki').html('Добавить подушки');
    }
    if(cat=='podushki'){
      jQuery('[data-deposit="podushki"]').remove();
      jQuery('[data-type="add-podushki"]').remove();
    }else{
      jQuery('#add-'+cat).removeAttr('name');
      jQuery('#add-'+cat).removeAttr('value');
      jQuery('#add-'+cat+'-deposit').removeAttr('name');
    }
    var oldPrice = parseInt(jQuery('.variation_id').attr('data-'+cat), 10);
    var dp = + jQuery('.summary .price .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - oldPrice;
    var rp = + jQuery('.summary .price del .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - oldPrice;
    var sp = + jQuery('.summary .price ins .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - oldPrice;
    jQuery('.variation_id').removeAttr('data-'+cat);
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+dp) + " ₽");
    jQuery('.summary .price del .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+rp) + " ₽");
    jQuery('.summary .price ins .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+sp) + " ₽");
    jQuery('#product__'+cat).parent('.product__variation').removeClass('choice');
    jQuery('#product__'+cat).parent('.product__variation').children('.product__delete').addClass('hidden');
  });
})