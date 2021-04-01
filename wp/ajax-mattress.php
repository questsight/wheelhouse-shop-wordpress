<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
$fix = false; 
if($_REQUEST['mattress-fix']){
  $fix = true;
  query_posts(array( 'post_type'=>'product', 'post__in' => $_REQUEST['mattress-fix']  ));
}else{
  query_posts($query_string.'post_type=product&product_cat=matrasy&posts_per_page=-1');
}
if ($_REQUEST && !empty($_REQUEST) && $_REQUEST['mattress-size']) {
  if ( have_posts() ) : $mattress = array(); while ( have_posts() ) : the_post();
  if ($product->is_type( 'variable' )){
    $available_variations = $product->get_available_variations();
    foreach ($available_variations as $key => $value){
      if($_REQUEST['mattress-size'] == '1400-2000' || $_REQUEST['mattress-size'] == '1600-2000' || $_REQUEST['mattress-size'] == '1800-2000' || $_REQUEST['mattress-size'] == '2000-2000'){
          $kr = true;
      }else{$kr = false;}
      if($value['attributes']['attribute_pa_size-krd']==$_REQUEST['mattress-size']&&$value['dimensions']['height']<=25&&$value['dimensions']['height']>=12&&!$kr || $value['attributes']['attribute_pa_size-krd']==$_REQUEST['mattress-size']&&$kr&&$value['dimensions']['height']>15){
        $fields = CFS()->get( 'matrasy-hardness' );
        if( ! empty($fields) ){
          foreach ( $fields as $key => $val ){
            $hardness = $val;
          }
        }
        $item = array(
			    'hardness' => $hardness, 
			    'variation_id' => $value['variation_id'],
			    'display_price' => $value['display_price'],
          'img' => $value['image']['url'],
          'name' => $product->name,
          'height' => $value['dimensions']['height'],
          'description' => $product->short_description
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
    if($fix){$price=0;}else{$price=$value['display_price'];}
    echo '<div style="border:1px solid rgba(171, 178, 204, 0.85);" class="listing__item mattress__item flip"><div class="flip__front"><img src="'.$value['img'].'"><div class="listing__title" style="text-transform:none;"><span id="title-name">'.$value['name'].'</span><br>Высота: '.$value['height'].'см<br>'.$value['hardness'].'</div><span class="listing__price">'.number_format($price, 0, ',', ' ').' ₽</span></div><div class="flip__back" data-price="'.$price.'" data-ids="'.$value['variation_id'].'">'.$value['description'].'</div></a></div>';
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
    price = parseInt(jQuery(this).attr('data-price'), 10);
    jQuery('.cloth__popup-title').html(mattress);
    jQuery('.cloth__popup').removeClass('hidden');
  });
  jQuery('#exit-mattress').on('click', function(){
    material = "";
    ids = "";
    price = "";
    jQuery('.cloth__popup').addClass('hidden');
  });
  jQuery('#choice-mattress').on('click', function(){
    jQuery('#product__mattress').html(jQuery('.cloth__popup-title').html());
    jQuery('#add-mattress').attr('name','add-more-to-cart');
    jQuery('#add-mattress').attr('value',ids);
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-mattress').addClass('hidden');
    jQuery('.mattress').addClass('hidden');
    if(jQuery('.variation_id').attr('data-addprice')){
      var addprice = parseInt(jQuery('.variation_id').attr('data-addprice'), 10);
    }else{
      var addprice = 0;
    }
    var dp = + jQuery('.summary .price .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - addprice;
    var rp = + jQuery('.summary .price del .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - addprice;
    var sp = + jQuery('.summary .price ins .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - addprice;
    jQuery('.variation_id').attr('data-addprice',price);
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+dp+price) + " ₽");
    jQuery('.summary .price del .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+rp+price) + " ₽");
    jQuery('.summary .price ins .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+sp+price) + " ₽");
  });
</script>