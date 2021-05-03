<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$colors = CFS()->get( 'colors', $_REQUEST['product-ids']);
$html;
if(CFS()->get( 'basic-description', $_REQUEST['product-ids'])):?>
 <div class="listing__item colors__item colors__basic" data-item="basic" data-type="basic">
   <img class="listing__foto" src="<?php if(CFS()->get( 'basic-img', $_REQUEST['product-ids'])){echo CFS()->get( 'basic-img', $_REQUEST['product-ids']);}else{echo CFS()->get( 'main-gallery', $_REQUEST['product-ids'])[0]['img-jpg'];}?>">
   <div class="listing__price"><?php echo priceColor(CFS()->get( 'price', $_REQUEST['product-ids']),$_REQUEST['product-ids']);?></div>
   <div class="listing__title">Basic</div>
  </div>
<?php endif;
foreach ( $colors as $key => $value ):?>
<div class="listing__item colors__item colors__color" data-item="<?php echo $key;?>" data-type="color" data-price="<?php echo array_key_first(CFS()->get( 'price', $value['material-price'][0]));?>">
  <img class="listing__foto" src="<?php echo array_shift($value['gallery'])['img-jpg'];?>">
  <div class="listing__price"><?php echo priceColor(CFS()->get( 'price', $value['material-price'][0]),$_REQUEST['product-ids']); ?></div>
  <div class="listing__title"><?php echo $value['color-name']; ?></div>
</div>
<?php endforeach;?>


<script>
var colors = <?php echo json_encode($colors) ?>;
jQuery('.colors__item').on('click', function(){
  var item = jQuery(this).attr('data-item');
  if(item == 'basic'){
    var name = 'Basic';
    var description = <?php echo json_encode(CFS()->get( 'basic-description', $_REQUEST['product-ids'])) ?>;
    var price = Object.keys(<?php echo json_encode(CFS()->get( 'price', $_REQUEST['product-ids'])) ?>)[0];
    var gallery = <?php echo json_encode(CFS()->get( 'main-gallery', $_REQUEST['product-ids'])) ?>;
  }else{
    var name = colors[item]['color-name'];
    var description = <?php echo json_encode(CFS()->get( 'color-description', $_REQUEST['product-ids'])) ?>;
    var price = jQuery(this).attr('data-price');
    var gallery = colors[item]['gallery'];
  }
  function first(p){for(var i in p)return p[i];}
  jQuery('.product__change').attr('src',first(gallery)['img-jpg']);
  jQuery('.product__color-name').html(name+'<span> - </span>');
  jQuery('.product__color-description').html(description);
  jQuery('[value="kategoriya-'+price+'"]').attr('selected','selected');
  jQuery('#pa_kategoriya-tkani').change();
  jQuery('[name="_color" ]').attr('value',name);
  jQuery('[name="_img" ]').attr('value',gallery[0]['img-jpg']);
  if(jQuery(this).attr('data-type')=='basic'){
    jQuery('.choice__color').addClass('hidden');
    jQuery('.choice__basic').removeClass('hidden');
    jQuery('[name="cloth-price"]').removeAttr('value');
    jQuery('[name="_material[]"]').each(function() {
      if(jQuery(this).attr('value') != "Стёганое полотно из микрофибры" && jQuery(this).attr('data-key') != "pillar"){
        jQuery(this).attr('value',"");
      }
    });
  }else{
    jQuery('.choice__basic').addClass('hidden');
    jQuery('.product__cloth-fix').each(function(){
      jQuery(this).html(colors[item]['materials'][jQuery(this).attr('data-item')]['material']);
      jQuery(this).attr('data-fix',colors[item]['materials'][jQuery(this).attr('data-item')]['material_img']);
      var elem = jQuery(this);
      jQuery('[name="_material[]"]').each(function() {
        if(jQuery(this).attr('value') != "Стёганое полотно из микрофибры" && jQuery(this).attr('data-key') != "pillar"){
          jQuery('[data-key="'+elem.attr('data-item')+'"]').attr('value',colors[item]['materials'][elem.attr('data-item')]['material']);
        }
      });
      jQuery('[name="cloth-price"]').attr('value',jQuery('#pa_kategoriya-tkani').val());
    })
    jQuery('.choice__color').removeClass('hidden'); 
  }
  jQuery('.choice__pillar').removeClass('hidden');
  /*console.log("test1");
  if( '' == jQuery('input.variation_id').val() && jQuery(this).attr('data-type')!='basic'){
    console.log("test");
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
    var dp = + jQuery(this).children('.listing__price').text().replace(/\â‚½.*//*, '').replace(/\s+/g, '') + addprice + option;
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(dp) + " â‚½");
  }*/
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