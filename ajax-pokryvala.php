<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
query_posts($query_string.'post_type=product&product_cat=pokryvala&posts_per_page=-1');
if ($_REQUEST && !empty($_REQUEST) && $_REQUEST['mattress-size'] && $_REQUEST['cloth-price']) {
  if ( have_posts() ) : $mattress = array(); while ( have_posts() ) : the_post();
  if ($product->is_type( 'variable' )){
    $available_variations = $product->get_available_variations();
    foreach ($available_variations as $key => $value){
      if($value['attributes']['attribute_pa_size-krd']==$_REQUEST['mattress-size'] && $value['attributes']['attribute_pa_kategoriya-tkani']==$_REQUEST['cloth-price']){
        $item = array(
			    'variation_id' => $value['variation_id'],
			    'display_price' => $value['display_price'],
          'img' => $value['image']['url'],
          'name' => $product->name,
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
    echo '<div style="border:1px solid rgba(171, 178, 204, 0.85);" class="listing__item mattress__item" data-price="'.round($price*0.7,-2).'" data-ids="'.$value['variation_id'].'" data-mid="'.$value['main_id'].'"><img src="'.$value['img'].'"><div class="listing__title" style="text-transform:none;"><span id="title-name">'.$value['name'].' в цвет обивки</span></div><span class="listing__price"><del>'.number_format($price, 0, ',', ' ').' ₽</del><ins>'.number_format(round($price*0.7,-2), 0, ',', ' ').' ₽</ins></span></div>';
  }
  else: do_action( 'woocommerce_no_products_found' );
  endif; 
  }else{
    echo '<p class="cloth__link">Сначала необходимо выбрать размер спального места и материал обивки'.$n.'.<br>Если у Вас возникли вопросы или сложности, Вы можете оформить <a href="'.get_permalink(142).'">индивидуальный заказ</a></p>';
  }?>
<div class="cloth__popup hidden">
    <div class="cloth__popup-title"></div>
    <div class="cloth__button" id="choice-mattress">Выбрать</div>
    <div class="cloth__button" id="exit-mattress">Посмотреть еще</div>
</div>
<script>
  var mattress;
  jQuery('#result-mattress .mattress__item').on('click', function(){
    mattress = jQuery(this).children('.listing__title').children('#title-name').html();
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
    jQuery('#product__pokryvala').html(jQuery('.cloth__popup-title').html());
    jQuery('#add-pokryvala').attr('name','add-more-to-cart[]');
    jQuery('#add-pokryvala').attr('value',ids);
    jQuery('#add-pokryvala-deposit').attr('name',mid+'-deposit-radio');
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-mattress').addClass('hidden');
    jQuery('.mattress').addClass('hidden');
    if(jQuery('.variation_id').attr('data-pokryvala')){
      var pokryvala = parseInt(jQuery('.variation_id').attr('data-pokryvala'), 10);
    }else{
      var pokryvala = 0;
    }
    var dp = + jQuery('.summary .price .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - pokryvala;
    var rp = + jQuery('.summary .price del .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - pokryvala;
    var sp = + jQuery('.summary .price ins .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - pokryvala;
    jQuery('.variation_id').attr('data-pokryvala',price);
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+dp+price) + " ₽");
    jQuery('.summary .price del .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+rp+price) + " ₽");
    jQuery('.summary .price ins .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+sp+price) + " ₽");
    jQuery('#product__pokryvala').parent('.product__variation').addClass('choice');
    jQuery('#product__pokryvala').parent('.product__variation').children('.product__delete').removeClass('hidden');
  });
</script>