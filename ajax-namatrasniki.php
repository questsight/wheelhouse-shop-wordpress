<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
query_posts($query_string.'post_type=product&product_cat=namatrasniki&posts_per_page=-1');
if ($_REQUEST && !empty($_REQUEST) && $_REQUEST['mattress-size']) {
  if ( have_posts() ) : $mattress = array(); while ( have_posts() ) : the_post();
  if ($product->is_type( 'variable' )){
    $available_variations = $product->get_available_variations();
    foreach ($available_variations as $key => $value){
      if($value['attributes']['attribute_pa_size-krd']==$_REQUEST['mattress-size']){
        $item = array(
			    'variation_id' => $value['variation_id'],
			    'display_price' => $value['display_price'],
          'img' => $value['image']['url'],
          'name' => $product->name,
          'description' => $product->short_description,
          'main_id' => $product->id
		    );
         $mattress[] = $item;
      }
    }
  }
  endwhile;
  usort($mattress, function($a,$b){
    return ($a['display_price']-$b['display_price']);
  });
  foreach ( $mattress as $key => $value ){
    $price=$value['display_price'];
    echo '<div style="border:1px solid rgba(171, 178, 204, 0.85);" class="listing__item mattress__item flip"><div class="flip__front"><img src="'.$value['img'].'"><div class="listing__title" style="text-transform:none;"><span id="title-name">'.$value['name'].'</span></div><span class="listing__price"><del>'.number_format($price, 0, ',', ' ').' ₽</del><ins>'.number_format(round($price*0.9,-2), 0, ',', ' ').' ₽</ins></span></div><div class="flip__back" data-price="'.round($price*0.9,-2).'" data-ids="'.$value['variation_id'].'" data-mid="'.$value['main_id'].'">'.$value['description'].'</div></a></div>';
  }
  else: do_action( 'woocommerce_no_products_found' );
  endif; 
  }else{
    echo '<p class="cloth__link">Сначала необходимо выбрать размер спального места '.$n.'.<br>Если у Вас возникли вопросы или сложности, Вы можете оформить <a href="'.get_permalink(142).'">индивидуальный заказ</a></p>';
  }?>
<div class="cloth__popup hidden">
    <div class="cloth__popup-title"></div>
    <div class="cloth__button" id="choice-mattress">Выбрать</div>
    <div class="cloth__button" id="exit-mattress">Посмотреть еще</div>
</div>
<script>
  var mattress;
  jQuery('#result-mattress .mattress__item .flip__back').on('click', function(){
    mattress = jQuery(this).parent( '.mattress__item' ).children('.flip__front').children('.listing__title').children('#title-name').html();
    ids = jQuery(this).attr('data-ids');
    mid = jQuery(this).attr('data-mid');
    price = parseInt(jQuery(this).attr('data-price'), 10);
    jQuery('.cloth__popup-title').html(mattress);
    jQuery('.cloth__popup').removeClass('hidden');
  });
  jQuery('#exit-mattress').on('click', function(){
    material = "";
    ids = "";
    mid = "";
    price = "";
    jQuery('.cloth__popup').addClass('hidden');
  });
  jQuery('#choice-mattress').on('click', function(){
    jQuery('#additional-namatrasniki .product__add-item').html(jQuery('.cloth__popup-title').html());
    jQuery('#additional-namatrasniki').removeClass('hidden');
    jQuery('#add-namatrasniki').attr('name','add-more-to-cart[]');
    jQuery('#add-namatrasniki').attr('value',ids);
    jQuery('#add-namatrasniki-deposit').attr('name',mid+'-deposit-radio');
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-mattress').addClass('hidden');
    jQuery('.mattress').addClass('hidden');
    if(jQuery('.variation_id').attr('data-namatrasniki')){
      var namatrasniki = parseInt(jQuery('.variation_id').attr('data-namatrasniki'), 10);
    }else{
      var namatrasniki = 0;
    }
    var dp = + jQuery('.summary .price .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - namatrasniki;
    var rp = + jQuery('.summary .price del .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - namatrasniki;
    var sp = + jQuery('.summary .price ins .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - namatrasniki;
    jQuery('.variation_id').attr('data-namatrasniki',price);
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+dp+price) + " ₽");
    jQuery('.summary .price del .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+rp+price) + " ₽");
    jQuery('.summary .price ins .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+sp+price) + " ₽");
    jQuery('#product__namatrasniki').parent('.product__variation').addClass('choice');
    jQuery('#product__namatrasniki').parent('.product__variation').children('.product__delete').removeClass('hidden');
  });
</script>