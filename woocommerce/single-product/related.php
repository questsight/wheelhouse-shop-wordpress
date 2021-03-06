<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
if(get_term( $product->category_ids[0], 'product_cat' )->slug != "v-nalichii" && get_term( $product->category_ids[0], 'product_cat' )->slug != "matrasy"){
foreach($product->category_ids as $cat){
  if(CFS()->get( get_term( $cat, 'product_cat' )->slug . '-collection' )){
    $value = array_key_first(CFS()->get( get_term( $cat, 'product_cat' )->slug . '-collection' ));
    break;
  }
}
if ( $related_products ) : ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php $rel=array(); foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
          if(count(array_intersect( $product->category_ids, $related_product->category_ids)) == count($related_product->category_ids)){
            foreach($related_product->category_ids as $cat){
              if(CFS()->get( get_term( $cat, 'product_cat' )->slug . '-collection' ) && array_key_exists($value, CFS()->get( get_term( $cat, 'product_cat' )->slug . '-collection' ))){
                $rel[]= $related_product;
                break;
              }
            }
          }
					?>

			<?php endforeach; ?>
			<?php if($rel){
          echo '<div class="product__subtitle">Похожие товары:</div>';
          $item = 0;
          foreach ( $rel as $rel_product ){
            $post_object = get_post( $rel_product->get_id() );
            setup_postdata( $GLOBALS['post'] =& $post_object );
            wc_get_template_part( 'content', 'product' );
            $item++;
            if($item == 4){
              break;
            }
          }
      };?>

		<?php woocommerce_product_loop_end(); ?>


	<?php
endif;
}
wp_reset_postdata();
