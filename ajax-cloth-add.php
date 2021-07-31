<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
if($_REQUEST['ids']){
$post = get_post($_REQUEST['ids']);
$item = $_REQUEST['item'];
$fields = CFS()->get( 'palette' );
if( ! empty($fields) ):
foreach ( get_the_category() as $key => $label ) {
    foreach ( $label as $key => $value ) {
        if($key == 'name' && $value != 'Материалы'){
                $cat = $value;
        }
    }
}
foreach ( $fields as $field ){?>        
<div class="cloth__item">
    <img class="listing__foto" src="<?php echo $field['icon-jpg'];?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>"  data-texture="<?php echo $field['texture'];?>">
    <div class="listing__title"><?php echo $cat;?> - <?php echo  $field['name-color'];;?></div>
</div>
<?php } endif;?> 
<p class="cloth__link">Мы не угадали? Вы можете оформить <a href="<?php echo get_permalink(142);?>/">индивидуальный заказ</a></p>
<div class="cloth__popup hidden">
    <div class="cloth__popup-title"></div>
    <div class="cloth__button" id="choice">Выбрать</div>
    <div class="cloth__button" id="exit">Посмотреть еще</div>
</div>
<?php }else{
    if($_REQUEST['product_cat'] == 'krovati'){
        $n = 'изголовья';
    }elseif($_REQUEST['product_cat'] == 'detskie-krovati'){
        $n = 'стенок и бортиков';
    }else{
        $n = 'основного материала';
    }
    echo '<p class="cloth__link">Сначала необходимо выбрать цвет '.$n.'.<br>Если у Вас возникли вопросы или сложности, Вы можете оформить <a href="'.get_permalink(142).'">индивидуальный заказ</a></p>';
}
?>
<script>
  var material;
  jQuery('#result-cloth .cloth__item').on('click', function(){
     material = jQuery(this).children('.listing__title').html();
     url = jQuery(this).children('.listing__foto').attr('data-texture');
     jQuery('.cloth__popup-title').html(material);
    jQuery('.cloth__popup').removeClass('hidden');
  });
  jQuery('#exit').on('click', function(){
    material = "";
    url ="";
    jQuery('.cloth__popup').addClass('hidden');
  });
  jQuery('#choice').on('click', function(){
    jQuery('[data-key="<?php echo $item;?>"]').attr('value',material);
    //jQuery('[data-item="<?php echo $item;?>"]').html(jQuery('.cloth__popup-title').html());
    jQuery('[data-item="<?php echo $item;?>"]').parent().addClass('choice');
    jQuery('[data-slug="material<?php echo $item;?>"]').html(jQuery('.cloth__popup-title').html());
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('#cloth__color').removeClass('hidden');
    jQuery('.cloth__color').removeClass('hidden');
    jQuery('.cloth').addClass('hidden');
    jQuery('iframe#v3d_iframe').contents().find('#material<?php echo $item;?>').focus();
    jQuery('iframe#v3d_iframe').contents().find('#material<?php echo $item;?>').val(url);
    jQuery('iframe#v3d_iframe').contents().find('#material<?php echo $item;?>').blur();
    var acc = 1;
    jQuery('[name="_material[]"]').each(function() {
      if(!jQuery(this).val()){
        acc = 0;
      }
    })
    if(acc==1){
      jQuery('#_material-title').removeClass("accent");
    }
  });
</script>