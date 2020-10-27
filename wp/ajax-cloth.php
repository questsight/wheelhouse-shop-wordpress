<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
query_posts($query_string.'&cat=34&posts_per_page=-1');
if ( have_posts() ) : 
$result = array();
$collection = $_REQUEST['collection'][0];
while ( have_posts() ) : the_post();
    if(array_key_exists($collection, CFS()->get('collection'))){
        $ids = get_the_ID();
        $fields = CFS()->get( 'palette' );
        if( ! empty($fields) ){
            foreach ( $fields as $field ){
                  $item = array();
                  $price = 0;
                  $item['name'] = $field['name-color'];
                  $item['jpg'] = $field['icon-jpg'];
                  $item['webp'] = $field['icon-webp'];
                  $item['link'] = get_the_permalink();
                  $item['ids'] = get_the_ID();
                  foreach ( get_the_category() as $key => $label ) {
                      foreach ( $label as $key => $value ) {
                          if($key == 'name' && $value != 'Материалы'){
                              $item['cat'] = $value;
                          }
                      }
                  }
                  $values = CFS()->get('price');
                  foreach ( $values as $key => $label ) {
                      $result['price'][$key][] = $item; 
                }
            }
        }
    }
endwhile; endif;
if(! empty($result)){
ksort($result['price']);
?>
<?php foreach ( $result['price'] as $k => $value ):?>
<div class="cloth__title">Категория №<?php echo $k;?></div>
<?php foreach ( $value as $key => $val ):?>
<div class="cloth__item" data-price="<?php echo $k;?>" data-ids='<?php echo $val['ids'] ;?>'>
    <img class="listing__foto" src="<?php echo $val['jpg'];?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
    <div class="listing__title"><?php echo $val['cat'];?> - <?php echo $val['name'];?></div>
</div>
 <?php endforeach; endforeach;?>
<p class="cloth__link">Мы не угадали? Вы можете оформить <a href="<?php echo get_permalink(142);?>">индивидуальный заказ</a></p>
<?php } else {?>
<p class="cloth__link">Мы не смогли автоматически подобрать подходящую ткань. Вы можете оформить <a href="<?php echo get_permalink(142);?>">индивидуальный заказ</a></p>
<?php } ?>
<div class="cloth__popup hidden">
    <div class="cloth__popup-title"></div>
    <div class="cloth__button" id="choice">Выбрать</div>
    <div class="cloth__button" id="exit">Посмотреть еще</div>
</div>
<script>
  var price;
  var material;
  jQuery('#result-cloth .cloth__item').on('click', function(){
     price = jQuery(this).attr('data-price');
     material = jQuery(this).children('.listing__title').html();
     ids = jQuery(this).attr('data-ids');
     jQuery('.cloth__popup-title').html(material);
    jQuery('.cloth__popup').removeClass('hidden');
  });
  jQuery('#exit').on('click', function(){
    price = "";
    material = "";
    ids = "";
    jQuery('.cloth__popup').addClass('hidden');
  });
  jQuery('#choice').on('click', function(){
    jQuery('[value="kategoriya-'+price+'"]').attr('selected','selected');
    jQuery('#pa_kategoriya-tkani').change();
    jQuery('[name="_material_0"]').attr('value',material);
    if(jQuery('[name="_material_1"]').attr('value') != "Стёганое полотно из микрофибры"){
      jQuery('[name="_material_1"]').attr('value',"");  
    }
    jQuery('[name="_material_2"]').attr('value',"");
    jQuery('.product__cloth').html(jQuery('.cloth__popup-title').html());
    jQuery('.product__cloth-add').html("Выбрать материал и цвет");
    jQuery('[data-ids]').attr('value',ids);
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('.cloth').addClass('hidden');
  });
</script>