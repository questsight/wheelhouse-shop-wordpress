<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
foreach($product->category_ids as $cat){
  if(CFS()->get( get_term( $cat, 'product_cat' )->slug . '-collection' )){
    $basic_cat = $cat;
    break;
  }
}
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="product__gallery images">
        <?php
		if ( $product->get_image_id() ) {
			$html = get_gallery_image_html( $product->get_image_id(), true );
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $product->get_image_id() ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		//do_action( 'woocommerce_product_thumbnails' );
            $fields = CFS()->get( 'gallery' );
            if( ! empty($fields) ):
            foreach ( $fields as $field ){?>
          <img class="product__img" data-src="<?php echo $field['img-jpg']; ?>" src="<?php echo $field['img-min']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
         <?php } endif;
            $fields = CFS()->get( 'schemes' );
            if( ! empty($fields) ):
            foreach ( $fields as $field ){?>
            
          <img class="product__img <?php if(!$field['selected']){echo "hidden ";}?>" data-scheme="<?php echo $field['scheme-size']; ?>" data-src="<?php echo $field['scheme-img']; ?>" src="<?php echo $field['scheme-mini']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
         <?php } endif;?>
	</div>
    <div class="product__description">
        <h1 class="product__title"><?php echo CFS()->get( 'title' );?></h1>
	    <div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	    </div>
    </div>
    <div class="product__popup cloth hidden">
        <div class="cloth__close">&times;</div>
            <form id='filter-cloth'>
                <input type="hidden" data-ids name="ids" value="<?php echo CFS()->get('ids');?>">
                <input type="hidden" data-item name="item" value="">
                <input type="hidden" name="product_cat" value="<? echo get_term( $basic_cat, 'product_cat' )->slug;?>">
                <?php if(!CFS()->get( 'fix-choice' )) {$values = CFS()->get(get_term( $basic_cat, 'product_cat' )->slug.'-collection');
                    foreach ( $values as $key => $label ) {
                        echo '<input type="hidden" name="collection[]" value="'.$key.'">';
                }}?>
            </form>
        <div class="listing hidden" id="result-cloth"></div>
    </div>
    <?php $categories = get_the_terms( $post->ID, 'product_cat' );
      $mattress = false;
      foreach ($categories as $category) {
        if($category->term_id == 23 || $category->term_id == 24){
          $mattress = true;
          break;
        }
      }
  if($mattress):?>
    <form id='mattress-size'>
      <input type="hidden" name="mattress-size" value="">
    </form>
    <div class="product__popup mattress hidden">
        <div class="mattress__close">&times;</div>
        <div class="listing hidden" data-size="big" data-flip='flip' id="result-mattress"></div>
    </div>
   <?php endif;?>
   <?php $fields = CFS()->get( 'mattress' ); if(!empty($fields)):?>
    <form id='mattress-size'>
      <input type="hidden" name="mattress-size" value="">
      <?php foreach($fields as $value):?>
      <input type="hidden" name="mattress-fix[]" value="<?php echo $value;?>">
      <?php endforeach;?>
    </form>
    <div class="product__popup mattress hidden">
        <div class="mattress__close">&times;</div>
        <div class="listing hidden" data-size="big" id="result-mattress" style="width:100%;"></div>
    </div>
   <?php endif;?>
</div>
	    <?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
	


<?php do_action( 'woocommerce_after_single_product' ); 
if(get_term( $basic_cat, 'product_cat' )->slug == 'detskie-krovati' || get_term( $basic_cat, 'product_cat' )->slug == 'krovati' ){
  wc_get_template_part( 'single-product/product', 'accessories' ); 
}?>