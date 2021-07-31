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
if(!is_shop() && !is_product_category('v-nalichii') && !is_product_category('services') &&!is_product_category('aksessuary')&&!is_product_category('detskie-krovati')&&!is_product_category('divany')&&!is_product_category('krovati')&&!is_product_category('podushki')&&!is_product_category('pokryvala')&&!is_product_category('chehly-na-matras')&&strpos(get_queried_object()->slug,'konfigurator')=== false && (!$_GET || $_GET && !array_key_exists("combination",$_GET) && !$_GET['combination'])): ?>

<?php wc_get_template_part( 'content', 'filter' ); endif; 
if ( woocommerce_product_loop() ) {

  if(!empty($_REQUEST['collection']) || !empty($_REQUEST['purpose']) || !empty($_REQUEST['color'])){
    echo '<div class="listing">';
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
              print_r(WC_Product_Addons_Helper::get_product_addons( $post_id, $prefix )[0]);
              //$product_addons = WC_Product_Addons_Helper::get_product_addons( $post_id, $prefix );
            setup_postdata($post);
            $colors = CFS()->get( 'colors',$post->ID);
            foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
              if($cat->name == "Конфигуратор"){
                $del = '/'.$cat->slug.'/';
                break;
              }
            }
            if(!empty($colors)){
              foreach ( $colors as $key => $value ):
                if((!$_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'] || $_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0]=='false' || array_key_exists($_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0], $value['marker'])) && (!$_GET['combination'] || $_GET['combination'][0]==$value['color-name'])){?>
                <a href="<?php echo str_replace($del,'/',get_permalink($post->ID)); echo"?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0]));if($_GET['detskie-krovati-size']){echo "&attribute_pa_size-krd=".$_GET['detskie-krovati-size'][0];}if($_GET['krovati-size']){echo "&attribute_pa_size-krd=".$_GET['krovati-size'][0];}?>" class="listing__item"><img src="<?php echo $value['gallery'][0]['img-jpg'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php echo get_the_title($post->ID); if(!$value['no-name']){echo " ".$value['color-name'];}?></div><span class="listing__price"><?php echo number_format(priceColor(CFS()->get( 'price', $value['material-price'][0]),$post->ID), 0, ',', ' ').' ₽'; ?></span></a>
              <?php } endforeach;
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
              if(!$_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'] || $_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0]=='false' || array_key_exists($_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0], $value['marker'])){ 
            if($_GET['detskie-krovati-size']){
                $sizePar = "&attribute_pa_size-krd=".$_GET['detskie-krovati-size'][0];
              }else if($_GET['krovati-size']){
                $sizePar = "&attribute_pa_size-krd=".$_GET['krovati-size'][0];
              }else{
                $sizePar = "";  
              }
              if(!$value['no-name']){
                $nameC = get_the_title($post->ID) ." " . $value['color-name'];
              }else{
                $nameC = get_the_title($post->ID);
              }
              $item = array(
			         'link' => str_replace($del,'/',get_permalink($post->ID))."?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0])).$sizePar, 
			         'price' => priceColor(CFS()->get( 'price', $value['material-price'][0]),$post->ID),
                'img' => $value['gallery'][0]['img-jpg'],
                'name' => $nameC,
		            );
         $filterProducts[] = $item;
            }
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
      <a href="<?php echo $filterProduct['link'];?>" class="listing__item"><img src="<?php echo $filterProduct['img'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php echo $filterProduct['name'];?></div><span class="listing__price"><?php echo number_format($filterProduct['price'], 0, ',', ' ').' ₽';?></span></a>
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
              <a href="<?php echo str_replace($del,'/',get_permalink()); echo"?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0]));?>" class="listing__item"><img src="<?php echo $value['gallery'][0]['img-jpg'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php the_title(); if(!$value['no-name']){echo " ".$value['color-name'];}?></div><span class="listing__price"><?php echo number_format(priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()), 0, ',', ' ').' ₽'; ?></span></a>
            <?php endforeach;
          }
        }
		  } 
    }
  }
  if(!empty($_REQUEST['collection']) || !empty($_REQUEST['purpose']) ){
    woocommerce_product_loop_end();
  } else {
    woocommerce_product_loop_end($echo = false);
  }
  if(!is_shop()):?>
  
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