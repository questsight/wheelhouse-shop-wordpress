<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
?>
<div class="woocommerce-product-attributes shop_attributes">
   <?php $categories = get_the_terms( $post->ID, 'product_cat' );
      $mattress = false;
      $size = false;
      foreach ($categories as $category) {
        if($category->term_id == 148){
            $size = true;
            break;
        }
      }
	if(!$size): foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
	    <div class="product__variation-size woocommerce-product-attributes-item woocommerce-product-attributes-item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<div class="product__variation-text woocommerce-product-attributes-item__label"><?php echo wp_kses_post( $product_attribute['label'] ); ?></div>
			<div class="product__variation-choice woocommerce-product-attributes-item__value">Чтобы узнать общие габаритные размеры изделия, выберите размер спального места</div>
		</div>
	<?php endforeach; endif;?>
</div>