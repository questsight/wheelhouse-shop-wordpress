<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
query_posts($query_string.'&cat=34&posts_per_page=-1');
if ( have_posts() ) : 
$result = array();
$collection = $_REQUEST['collection'];
$console = array();
while ( have_posts() ) : the_post();
foreach($collection as $val):
    if(array_key_exists($val, CFS()->get('collection'))){
        $console[]=get_the_title();
        $ids = get_the_ID();
        $fields = CFS()->get( 'palette' );
        if( ! empty($fields) ){
            foreach ( $fields as $field ){
                  $item = array();
                  $price = 0;
                  $item['name'] = $field['name-color'];
                  $item['jpg'] = $field['icon-jpg'];
                  $item['texture'] = $field['texture'];
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
      break;
    }
endforeach; endwhile; endif;
if(! empty($result)){
ksort($result['price']);
?>
<?php foreach ( $result['price'] as $k => $value ):?>
<div class="cloth__title">Категория №<?php echo $k;?></div>
<?php foreach ( $value as $key => $val ):?>
<div class="cloth__item" data-price="<?php echo $k;?>" data-ids='<?php echo $val['ids'] ;?>'>
    <img class="listing__foto" src="<?php echo $val['jpg'];?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>" data-texture="<?php echo $val['texture'];?>">
    <div class="listing__title"><?php echo $val['cat'];?> - <?php echo $val['name'];?></div>
</div>
 <?php endforeach; endforeach;?>
<p class="cloth__link">Мы не угадали? Вы можете оформить <a href="<?php echo get_permalink(142);?>">индивидуальный заказ</a></p>
<?php } else {?>
<p class="cloth__link">Мы не смогли автоматически подобрать подходящую ткань. Вы можете оформить <a href="<?php echo get_permalink(142);?>">индивидуальный заказ</a></p>
<?php } ?>
<div class="cloth__popup hidden">
    <div class="cloth__popup-title"></div>
    <div class="cloth__button"id="choice">Выбрать</div>
    <div class="cloth__button" id="exit">Посмотреть еще</div>
</div>
<script>
  var price;
  var material;
  console.log(<?php echo json_encode($console) ?>)
  jQuery('#result-cloth .cloth__item').on('click', function(){
     price = jQuery(this).attr('data-price');
     material = jQuery(this).children('.listing__title').html();
     ids = jQuery(this).attr('data-ids');
     url = jQuery(this).children('.listing__foto').attr('data-texture');
     jQuery('.cloth__popup-title').html(material);
     jQuery('.cloth__popup').removeClass('hidden');
  });
  jQuery('#exit').on('click', function(){
    price = "";
    material = "";
    ids = "";
    url="";
    jQuery('.cloth__popup').addClass('hidden');
  });
  jQuery('#choice').on('click', function(){
    jQuery('[value="kategoriya-'+price+'"]').attr('selected','selected');
    jQuery('#pa_kategoriya-tkani').change();
    jQuery('[name="_material[]"]').each(function() {
      if(jQuery(this).attr('value') != "Стёганое полотно из микрофибры" && jQuery(this).attr('data-key') != "pillar"){
        jQuery(this).attr('value',"");
      }
    });
    jQuery('[data-key="0"]').attr('value',material);
    jQuery('[name="cloth-price"]').attr('value',jQuery('#pa_kategoriya-tkani').val());
    //jQuery('.product__cloth').html(jQuery('.cloth__popup-title').html());
    //jQuery('.product__cloth-add').html("Выбрать материал и цвет");
    jQuery('.product__cloth').parent().addClass('choice');
    jQuery('.product__cloth-add').parent().removeClass('choice');
    jQuery('[data-slug="material0"]').html(jQuery('.cloth__popup-title').html());
    jQuery('[data-ids]').attr('value',ids);
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('.cloth').addClass('hidden');
    jQuery('iframe#v3d_iframe').contents().find('#material0').focus();
    jQuery('iframe#v3d_iframe').contents().find('#material0').val(url);
    jQuery('iframe#v3d_iframe').contents().find('#material0').blur();
  });
</script>