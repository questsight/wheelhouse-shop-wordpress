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
if(is_product_category('podushki') || !is_shop() && !is_product_category('superczena') && !check_if_category_has_child(get_queried_object())): ?>
<div class="content__box">
<?php wc_get_template_part( 'content', 'filter' ); endif; if ( woocommerce_product_loop() ) {
    
    if(!empty($_REQUEST['collection']) || !empty($_REQUEST['purpose'])){
        echo '<div class="listing" data-size="big">';
    }
    woocommerce_product_loop_start();
	if ( wc_get_loop_prop( 'total' )) {
    if ($_GET && !empty($_GET)) {
      $products = go_filter_shop();
      if ( $products ) :
		    foreach( $products as $post ): setup_postdata($post);
        do_action( 'woocommerce_shop_loop' );
        wc_get_template_part( 'content', 'product' );
        endforeach; endif;
    }else{
      while ( have_posts() ) {
			the_post();
			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
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