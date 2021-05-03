<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 * php dynamic_sidebar('filter');//???????? ???????
 */
do_action( 'woocommerce_before_main_content' );
if(!is_shop() && !is_product_category('v-nalichii') && !is_product_category('services') &&!is_product_category('aksessuary')): ?>
<div class="content__box">
<?php wc_get_template_part( 'content', 'filter' ); endif; 
if ( woocommerce_product_loop() ) {

  if(!empty($_REQUEST['collection']) || !empty($_REQUEST['purpose'])){
    echo '<div class="listing" data-size="big">';
  }
  woocommerce_product_loop_start();
  if ( wc_get_loop_prop( 'total' )) {
    
    if ($_GET && !empty($_GET)){
      $products = go_filter_shop();
      if ( $products ) {
        if(strpos(get_queried_object()->slug,'konfigurator')!== false || get_queried_object()->slug == 'v-nalichii' || get_queried_object()->slug == 'services' || get_term( get_queried_object()->parent )->slug == 'aksessuary'){
          foreach( $products as $post ){
            setup_postdata($post);
            wc_get_template_part( 'content', 'product' );
          }
        }elseif(!$_GET['orderby'] || $_GET['orderby']=='none'){
          foreach( $products as $post ){
            setup_postdata($post);
            $colors = CFS()->get( 'colors',$post->ID);
            foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
              if($cat->name == "Конфигуратор"){
                $del = '/'.$cat->slug.'/';
                break;
              }
            }
            if(!empty($colors)){
              foreach ( $colors as $key => $value ): ?>
                <a href="<?php echo str_replace($del,'/',get_permalink()); echo"?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0]));?>" class="listing__item"><img src="<?php echo $value['gallery'][0]['img-jpg'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php the_title(); echo " ".$value['color-name']?></div><span class="listing__price"><?php echo priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()); ?></span></a>
              <?php endforeach;
            }
          }
        }else{
          $filterProducts = array();
          foreach( $products as $post ){
            setup_postdata($post);
            $colors = CFS()->get( 'colors',$post->ID);
            foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
              if($cat->name == "Конфигуратор"){
                $del = '/'.$cat->slug.'/';
                break;
              }
            }
            if(!empty($colors)){
            foreach ( $colors as $key => $value ){
              $item = array(
			         'link' => str_replace($del,'/',get_permalink($post->ID))."?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0])), 
			         'price' => priceColor(CFS()->get( 'price', $value['material-price'][0]),$post->ID),
                'img' => $value['gallery'][0]['img-jpg'],
                'name' => get_the_title($post->ID) ." " . $value['color-name'],
		            );
         $filterProducts[] = $item;
        }
      } 
    }
    if($_GET['orderby']=='priced'){
      usort($filterProducts, function($a,$b){
        return ($b['price']-$a['price']);
      }); 
    }else{
      usort($filterProducts, function($a,$b){
        return ($a['price']-$b['price']);
      }); 
    }
    foreach ( $filterProducts as $key => $filterProduct ): ?>
      <a href="<?php echo $filterProduct['link'];?>" class="listing__item"><img src="<?php echo $filterProduct['img'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php echo $filterProduct['name'];?></div><span class="listing__price"><?php echo $filterProduct['price'];?></span></a>
    <?php endforeach; 
        }
      }
    }else{
      while ( have_posts() ) {
		    the_post();
        do_action( 'woocommerce_shop_loop' );
        if(strpos(get_queried_object()->slug,'konfigurator')!== false || is_product_category('v-nalichii') || is_product_category('services') || get_term( get_queried_object()->parent )->slug == 'aksessuary'){
           wc_get_template_part( 'content', 'product' );
        }else{
          $colors = CFS()->get( 'colors');
          foreach(get_the_terms( $post->ID, 'product_cat' ) as $category){
            if($category->name == "Конфигуратор"){
              $del = '/'.$category->slug.'/';
              break;
            }
          }
          if(!empty($colors)){
            foreach ( $colors as $key => $value ): ?>
              <a href="<?php echo str_replace($del,'/',get_permalink()); echo"?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0]));?>" class="listing__item"><img src="<?php echo $value['gallery'][0]['img-jpg'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php the_title(); echo " ".$value['color-name']?></div><span class="listing__price"><?php echo priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()); ?></span></a>
            <?php endforeach;
          } 
        }
		  } 
    }
  }
  if(!empty($_REQUEST['collection']) || !empty($_REQUEST['purpose'])){
    woocommerce_product_loop_end();
  } else {
    woocommerce_product_loop_end($echo = false);
  }
  if(!is_shop()):?>
  </div>
<?php endif;
	
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
get_footer();