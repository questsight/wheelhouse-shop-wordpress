<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
query_posts($query_string.'post_type=product&product_cat=podushki&posts_per_page=-1');
if ($_REQUEST && !empty($_REQUEST) && $_REQUEST['cloth-price']) {
  if ( have_posts() ) : $mattress = array(); while ( have_posts() ) : the_post();
  if ($product->is_type( 'variable' )){
    $available_variations = $product->get_available_variations();
    foreach ($available_variations as $key => $value){
      if($value['attributes']['attribute_pa_kategoriya-tkani']==$_REQUEST['cloth-price']){
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
    //echo '<div style="border:1px solid rgba(171, 178, 204, 0.85);" class="listing__item mattress__item flip"><div class="flip__front"><img src="'.$value['img'].'"><div class="listing__title" style="text-transform:none;"><span id="title-name">'.$value['name'].'</span></div><span class="listing__price"><del>'.number_format($price, 0, ',', ' ').' ₽</del><ins>'.number_format(round($price*0.7,-2), 0, ',', ' ').' ₽</ins></span></div><div class="flip__back podushki__back"><input class="podushki__input" type="number" step="1" min="0" max="" size="1" value="1"><div class="podushki__add-item"  data-price="'.round($price*0.7,-2).'" data-ids="'.$value['variation_id'].'" data-mid="'.$value['main_id'].'">Добавить</div></div></a></div>';
    echo '<div style="border:1px solid rgba(171, 178, 204, 0.85);" class="listing__item mattress__item flip"><div class="flip__front"><img src="'.$value['img'].'"><div class="listing__title" style="text-transform:none;"><span id="title-name">'.$value['name'].'</span></div><span class="listing__price"><del>'.number_format($price, 0, ',', ' ').' ₽</del><ins>'.number_format(round($price*0.7,-2), 0, ',', ' ').' ₽</ins></span></div><div class="flip__back podushki__back" data-price="'.round($price*0.7,-2).'" data-ids="'.$value['variation_id'].'" data-mid="'.$value['main_id'].'"><div class="podushki__symbol hidden" id="minus">-</div><div class="podushki__quantity">0</div><div class="podushki__symbol" id="plus">+</div></div></a></div>';
  }
  else: do_action( 'woocommerce_no_products_found' );
  endif;
  echo '<div class="podushki__add"><div class="podushki__button" id="choice-mattress">Добавить в заказ</div></div>';
  }else{
    echo '<p class="cloth__link">Сначала необходимо выбрать материал обивки'.$n.'.<br>Если у Вас возникли вопросы или сложности, Вы можете оформить <a href="'.get_permalink(142).'">индивидуальный заказ</a></p>';
  }?>
<script>
jQuery('#pa_kategoriya-tkani').change(function() {
  jQuery('[data-deposit="podushki"]').remove();
  jQuery('[data-type="add-podushki"]').remove();
  if(typeof podushki !== 'undefined'){
    podushki = [];
  };
});
if(typeof podushki !== 'undefined'){
  podushki.forEach(function(item) {
  jQuery('[data-ids='+item.ids+']').parent( '.mattress__item' ).children('.flip__front').addClass('podushki__front');
  jQuery('[data-ids='+item.ids+']').children('.podushki__quantity').text(item.сalc);
  jQuery('[data-ids='+item.ids+']').children("#minus").removeClass("hidden");
});
}else{
  var podushki = new Array();
}
  
  jQuery('.podushki__symbol').on('click', function(){
    var сalc = jQuery(this).parent('.flip__back').children('.podushki__quantity').text();
    var ids = jQuery(this).parent('.flip__back').attr('data-ids');
    var mattress = jQuery(this).parent('.flip__back').parent( '.mattress__item' ).children('.flip__front').children('.listing__title').children('#title-name').html();
    var mid = jQuery(this).parent('.flip__back').attr('data-mid');
    var price = parseInt(jQuery(this).parent('.flip__back').attr('data-price'), 10);
    if(jQuery(this).attr('id')=="plus"){
      сalc = +сalc+1;
    }else{
      сalc = +сalc-1;
    }
    jQuery(this).parent('.flip__back').children('.podushki__quantity').text(сalc);
    var item = {"mattress":mattress, "ids":ids, "mid":mid,"price":price,"сalc":сalc};
    if(podushki.length > 0 && jQuery(this).parent('.flip__back').parent( '.mattress__item' ).children('.flip__front').hasClass('podushki__front')){
      podushki = podushki.filter(function(item) {
        return item.ids != ids;
      });
    }
    if(сalc > 0){
      podushki.push(item);
      jQuery(this).parent('.flip__back').parent( '.mattress__item' ).children('.flip__front').addClass('podushki__front');
      jQuery(this).parent('.flip__back').children("#minus").removeClass("hidden");
    }else{
      jQuery(this).parent('.flip__back').parent( '.mattress__item' ).children('.flip__front').removeClass('podushki__front');
      jQuery(this).parent('.flip__back').children("#minus").addClass("hidden");
    }
  });
  jQuery('#choice-mattress').on('click', function(){
    var priceTotal = 0;
    jQuery('[data-deposit="podushki"]').remove();
    jQuery('[data-type="add-podushki"]').remove();
    if(podushki.length == 0){
      var nameTotal = "<span>Добавить подушки</span>";
      jQuery('#product__podushki').parent('.product__variation').removeClass('choice');
    jQuery('#product__podushki').parent('.product__variation').children('.product__delete').addClass('hidden');
    }else{
      var nameTotal = "<span>Подушки:<br></span>";
      jQuery('#product__podushki').parent('.product__variation').addClass('choice');
    jQuery('#product__podushki').parent('.product__variation').children('.product__delete').removeClass('hidden');
    }
    podushki.forEach(function(item) {
      for (var i = 0; i < item.сalc; i++) {
        var newElems = jQuery('<input data-type="add-podushki" type="hidden" name="add-more-to-cart[]" value="'+item.ids+'">');
        jQuery('#description').append(newElems);
      }
      priceTotal = priceTotal + item.сalc*item.price;
      nameTotal = nameTotal + '<span>' + item.mattress + " - " + item.сalc + "шт.<br></span>"
      var newDeposit = jQuery('<input data-type="add-deposit" data-deposit="podushki" type="hidden" class="input-radio" value="full" name="'+item.mid+'-deposit-radio">');
      jQuery('.basic-switch-woocommerce-deposits').append(newDeposit);
    });
    jQuery('#product__podushki').html(nameTotal);
    if(jQuery('.variation_id').attr('data-podushki')){
      var podushkiOld = parseInt(jQuery('.variation_id').attr('data-podushki'), 10);
    }else{
      var podushkiOld = 0;
    }
    var dp = + jQuery('.summary .price .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - podushkiOld;
    var rp = + jQuery('.summary .price del .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - podushkiOld;
    var sp = + jQuery('.summary .price ins .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - podushkiOld;
    jQuery('.variation_id').attr('data-podushki',priceTotal);
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+dp+priceTotal) + " ₽");
    jQuery('.summary .price del .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+rp+priceTotal) + " ₽");
    jQuery('.summary .price ins .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+sp+priceTotal) + " ₽");
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-mattress').addClass('hidden');
    jQuery('.mattress').addClass('hidden');
  });
</script>