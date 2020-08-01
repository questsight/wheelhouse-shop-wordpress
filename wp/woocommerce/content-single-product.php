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
        <div class="product__meta hidden">
            <?php
            $values = CFS()->get( get_term( $product->category_ids[0], 'product_cat' )->slug . '-size' );
            if($values){
                echo '<div class="product__meta-title">Размер: ';
                $parameter = array();
                foreach ( $values as $key => $label ) {
                    $parameter[]= '<a href="'.get_category_link( $product->category_ids[0] ).'?'.get_term( $product->category_ids[0], 'product_cat' )->slug.'-size%5B%5D='.$key.'">'.$label.'</a>';
                }
                $parameter = implode('<span>, </span>',$parameter);
                echo $parameter;
                echo '</div>';
            }
            $values = CFS()->get( get_term( $product->category_ids[0], 'product_cat' )->slug . '-function' );
            if($values){
                echo '<div class="product__meta-title">Функции: ';
                $parameter = array();
                foreach ( $values as $key => $label ) {
                    $parameter[]= '<a href="'.get_category_link( $product->category_ids[0] ).'?'.get_term( $product->category_ids[0], 'product_cat' )->slug.'-function%5B%5D='.$key.'">'.$label.'</a>';
                }
                $parameter = implode('<span>, </span>',$parameter);
                echo $parameter;
                echo '</div>';
            }
            $values = CFS()->get( get_term( $product->category_ids[0], 'product_cat' )->slug . '-purpose' );
            if($values){
                echo '<div class="product__meta-title">Назначение: ';
                $parameter = array();
                foreach ( $values as $key => $label ) {
                    $parameter[]= '<a href="https://wheelhousedesign.ru/katalog/?purpose%5B%5D='.$key.'">'.$label.'</a>';
                }
                $parameter = implode('<span>, </span>',$parameter);
                echo $parameter;
                echo '</div>';
            }
            if($product->category_ids[0] == 24){
                echo '<div class="product__meta-title">Назначение: <a href="https://wheelhousedesign.ru/katalog/?purpose%5B%5D=home-children">HOME/для детской</a></div>';
            }
            $values = CFS()->get( get_term( $product->category_ids[0], 'product_cat' )->slug . '-collection' );
            if($values){
                echo '<div class="product__meta-title">Коллекция: ';
                $parameter = array();
                foreach ( $values as $key => $label ) {
                    $parameter[]= '<a href="https://wheelhousedesign.ru/katalog/?collection%5B%5D='.$key.'">'.$label.'</a>';
                }
                $parameter = implode('<span>, </span>',$parameter);
                echo $parameter;
                echo '</div>';
            }
            ?>
        </div>
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
        <div class="listing" id="cloth__color">
            <div class="cloth__title">Выберите цвет ткани</div>
            <?php $fields = CFS()->find_fields( array( 'field_name' => 'marker' ))['0']['options']['choices'];
                foreach ($fields as $key => $value) { ?>
                <div class="listing__item cloth__color" data-color="<?php echo $key; ?>">
                    <div class="listing__title"><?php echo $value; ?></div>
                </div>
            <?php } ?>
            <form id='filter-cloth'>
                <input type="hidden" data-ids name="ids" value="<?php echo CFS()->get('ids');?>">
                <input type="hidden" data-item name="item" value="">
                <input type="hidden" data-marker name="marker[]" value="">
                <input type="hidden" name="product_cat" value="<? echo get_term( $product->category_ids[0], 'product_cat' )->slug;?>">
                <?php $values = CFS()->get(get_term( $product->category_ids[0], 'product_cat' )->slug.'-collection');
                    foreach ( $values as $key => $label ) {
                        echo '<input type="hidden" name="collection[]" value="'.$key.'">';
                }?>
            </form>
        </div>
        <div class="listing hidden" id="result-cloth"></div>
    </div>
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
	


<?php do_action( 'woocommerce_after_single_product' ); ?>