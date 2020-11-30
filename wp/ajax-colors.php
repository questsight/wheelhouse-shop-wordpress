<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$colors = CFS()->get( 'colors', $_REQUEST['product-ids']);
function price($category){
  foreach($category as $k => $v){
    $category = 'kategoriya-'.$k;
  }
  $product = wc_get_product( $_REQUEST['product-ids']);
  if ($product->is_type( 'variable' )){
    $available_variations = $product->get_available_variations();
    if($_REQUEST['mattress-size']){
      foreach ($available_variations as $key => $value){
        if($value['attributes']['attribute_pa_kategoriya-tkani'] == $category && $value['attributes']['attribute_pa_size-krd']==$_REQUEST['mattress-size']){
          return $value['price_html'];
          break;
        }
      } 
    }else{
      $items = array();
      foreach ($available_variations as $key => $value){
        if($value['attributes']['attribute_pa_kategoriya-tkani'] == $category){
          $items[]=$value['display_price'];
        }
      }
      sort($items);
      return number_format($items[0], 0, ',', ' ').' ₽';
    }
  }
}
$html;
foreach ( $colors as $key => $value ):
if(!$value['basic']):
?>
<div class="listing__item colors__item colors__color" data-item="<?php echo $key;?>" data-type="color">
  <img class="listing__foto" src="<?php echo array_shift($value['gallery'])['img-jpg'];?>">
  <div class="listing__price"><?php echo price($value['price']); ?></div>
  <div class="listing__title"><?php echo $value['color-name']; ?></div>
</div>
<?php else:echo '<div class="listing__item colors__item colors__basic" data-item="'.$key.'" data-type="basic"><img class="listing__foto" src="'.array_shift($value['gallery'])['img-jpg'].'"><div class="listing__price">'.price($value['price']).'</div><div class="listing__title">'.$value['color-name'].'</div></div>';endif;endforeach;?>


<script>
var colors = <?php echo json_encode($colors) ?>;
jQuery('.colors__item').on('click', function(){
  var item = jQuery(this).attr('data-item');
  var name = colors[item]['color-name'];
  var description = colors[item]['color-description'];
  var gallery = colors[item]['gallery'];
  function first(p){for(var i in p)return p[i];}
  jQuery('.product__change').attr('src',first(gallery)['img-jpg']);
  jQuery('.product__color-name').html(name+'<span> - </span>');
  jQuery('.product__color-description').html(description);
  jQuery('[value="kategoriya-'+Object.keys(colors[item]['price'])[0]+'"]').attr('selected','selected');
  jQuery('#pa_kategoriya-tkani').change();
  if(jQuery(this).attr('data-type')=='basic'){
    jQuery('.choice__color').addClass('hidden');
    jQuery('.choice__basic').removeClass('hidden');
  }else{
    jQuery('.choice__basic').addClass('hidden');
    jQuery('.product__cloth-fix').each(function(){
      jQuery(this).html(colors[item]['materials'][jQuery(this).attr('data-item')]['material']);
      jQuery(this).attr('data-fix',colors[item]['materials'][jQuery(this).attr('data-item')]['material_img']);
      jQuery('[data-key="'+jQuery(this).attr('data-item')+'"]').attr('value',colors[item]['materials'][jQuery(this).attr('data-item')]['material']);
    })
    jQuery('.choice__color').removeClass('hidden'); 
  }
  jQuery('.choice__pillar').removeClass('hidden');
  if( '' == jQuery('input.variation_id').val() && jQuery(this).attr('data-type')!='basic'){
    if(jQuery('.variation_id').attr('data-option')){
      var option = parseInt(jQuery('.variation_id').attr('data-option'), 10);
    }else{
      var option = 0;
    }
    if(jQuery('.variation_id').attr('data-addprice')){
      var addprice = parseInt(jQuery('.variation_id').attr('data-addprice'), 10);
    }else{
      var addprice = 0;
    }
    var dp = + jQuery(this).children('.listing__price').text().replace(/\₽.*/, '').replace(/\s+/g, '') + addprice + option;
    jQuery('.summary .price .woocommerce-Price-amount').html(new Intl.NumberFormat('ru-RU').format(dp) + " ₽");
  }
  jQuery('.colors').addClass('animation-opacity-hidden');
  function imgDisplay(){
    jQuery('.product__foto').removeClass('animation-opacity-0');
    jQuery('.product__foto').removeClass('animation-opacity-display');
  }
  function imgChange(){
    jQuery('[data-gallery="gallery"]').remove();
    jQuery.each(gallery,function(index,value){
      jQuery(".product__foto").prepend("<img class='product__img' data-src='"+value['img-jpg']+"' src='"+value['img-min']+"' data-gallery='gallery'>");
    })
    jQuery(".product__img").on('click', function(){
      jQuery('.product__first img').attr('src',jQuery(this).attr('data-src'));
    }); 
    jQuery('.magniflier').attr('src',jQuery('.product__change').attr('src'))
      //.on("load", function(){
      jQuery('.magniflier').removeClass('animation-opacity-hidden');
      jQuery('.product__change').removeClass('animation-translate');
      jQuery('.product__foto').addClass('animation-opacity-0');
      jQuery('.product__foto').removeClass('animation-opacity-hidden');
      jQuery('.product__foto').addClass('animation-opacity-display');
      setTimeout(imgDisplay, 1500);
    //});
  }
  function colorsHidden(){
    jQuery('.colors').removeClass('animation-opacity-hidden').addClass('hidden');
    jQuery('#result-colors').addClass('hidden');
    jQuery('.magniflier').addClass('animation-opacity-hidden');
    jQuery('.product__foto').addClass('animation-opacity-hidden');
    jQuery('.product__change').addClass('animation-translate');
    setTimeout(imgChange, 1500);
  }
  setTimeout(colorsHidden, 1500);
    
  });
</script>