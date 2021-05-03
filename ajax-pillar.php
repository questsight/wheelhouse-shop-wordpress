<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
query_posts($query_string.'&cat=168&posts_per_page=-1');
if ( have_posts() ) : 
$collection = $_REQUEST['collection'];
foreach($collection as $val):
while ( have_posts() ) : the_post();
    if(array_key_exists($val, CFS()->get('collection'))){
        echo '<div class="pillar__title">';
        the_title();
        echo '</div>';
        $fields = CFS()->get( 'palette' );
        if( ! empty($fields) ){
            foreach ( $fields as $field ){
             echo '<div class="listing__item pillar__item" data-name="'. get_the_title() .'"><img class="listing__foto" src="'. $field['icon-jpg'].'"><div class="listing__title">'.$field['name-color'].'</div></div>';
            }
        }
    }
endwhile; endforeach; endif;

?>

<p class="pillar__link">Мы не угадали? Вы можете оформить <a href="<?php echo get_permalink(142);?>">индивидуальный заказ</a></p>
<div class="pillar__popup hidden">
    <div class="pillar__popup-title"></div>
    <div class="pillar__button" id="choice-pillar">Выбрать</div>
    <div class="pillar__button" id="exit-pillar">Посмотреть еще</div>
</div>
<script>
  var pillar;
  jQuery('#result-pillar .pillar__item').on('click', function(){
    pillar = jQuery(this).attr('data-name') + " - " + jQuery(this).children('.listing__title').html();
    jQuery('.pillar__popup-title').html(pillar);
    jQuery('.pillar__popup').removeClass('hidden');
  });
  jQuery('#exit-pillar').on('click', function(){
    pillar = "";
    jQuery('.pillar__popup').addClass('hidden');
  });
  jQuery('#choice-pillar').on('click', function(){
    jQuery('[data-key="pillar"]').attr('value',pillar);
    jQuery('.product__pillar').html(jQuery('.pillar__popup-title').html());
    jQuery('.pillar__popup').addClass('hidden');
    jQuery('#result-pillar').addClass('hidden');
    jQuery('.pillar').addClass('hidden');
  });
</script>