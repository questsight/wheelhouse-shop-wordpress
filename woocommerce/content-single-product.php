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
<?php if(!$product->is_type('booking')):?>
  <div class="product__gallery">
    <?php
    if($_GET['color']){
      foreach(CFS()->get( 'colors' ) as $key => $value ){
        if($value['color-name']==$_GET['color']){
          $fields = $value['gallery'];
          break;
        }
      }
    }else{
      $fields = CFS()->get( 'main-gallery' ); 
    }
    if( ! empty($fields) ):
    $itk = 0;
    foreach ( $fields as $key => $field ): if($itk==0): $itk++;?>
      <div class='product__first'>
        <img src="<?php echo $field['img-jpg']; ?>" class="magniflier">
        <img src="<?php echo $field['img-jpg']; ?>" class="product__change">
      </div>
      <div class='product__foto'>
      <?php endif;?>
      <img class="product__img" data-src="<?php echo $field['img-jpg']; ?>" src="<?php echo $field['img-min']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>" data-gallery="gallery">
    <?php endforeach;
      $schemes = CFS()->get( 'schemes' );
      if( ! empty($schemes) ):
      foreach ( $schemes as $scheme ):?>    
      <img class="product__img <?php if(!$scheme['selected']){echo "hidden";}?>" data-scheme="<?php echo $scheme['scheme-size']; ?>" data-src="<?php echo $scheme['scheme-img']; ?>" src="<?php echo $scheme['scheme-mini']; ?>">
        <?php endforeach; endif;?>
      </div>
      <?php else:?>
    <div class='product__first'>
        <img<?php if(has_term( 'matrasy', 'product_cat' ) || has_term( 'namatrasniki', 'product_cat' )){echo ' class="magniflier"';}?> src="<?php the_post_thumbnail_url(); ?>">
      </div>
    <?php endif;?>
	</div>
    <div class="product__description">
        <h1 class="product__title"><?php if(CFS()->get( 'title' )){echo CFS()->get( 'title' );}else{the_title();}?></h1>
	    <div class="summary entry-summary">
        <?php endif;?>
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
            <?php if(!$product->is_type('booking')):?>  
	    </div>  
    </div>
    <?php endif;?>
    <div class="product__popup cloth hidden">
        <div class="cloth__close">&times;</div>
            <form id='filter-cloth'>
                <input type="hidden" data-ids name="ids" value="<?php echo CFS()->get('ids');?>">
                <input type="hidden" data-item name="item" value="">
                <input type="hidden" name="product_cat" value="<? echo get_term( $basic_cat, 'product_cat' )->slug;?>">
                <?php $values = CFS()->get(get_term( $basic_cat, 'product_cat' )->slug.'-collection');
                    foreach ( $values as $key => $label ) {
                        echo '<input type="hidden" name="collection[]" value="'.$key.'">';
                }?>
            </form>
        <div class="listing hidden" id="result-cloth"></div>
    </div>
    <?php $categories = get_the_terms( $post->ID, 'product_cat' );
      $mattress = false;
      $aksessuary = false;
      $services = false;
      foreach ($categories as $category) {
        if($category->term_id == 23 || $category->term_id == 24){
          $mattress = true;
          break;
        }
        if(get_ancestors($category->term_id,'product_cat')[0] == 33){
          $aksessuary = true;
          break;
        }
        if($category->term_id == 170){
           $services = true;
          break;
        }
      }
  if($mattress && !CFS()->get( 'add-more' )):?>
    <form id='mattress-size'>
      <input type="hidden" name="mattress-size" value="">
      <input type="hidden" name="cloth-price" value="<?php if($_GET['attribute_pa_kategoriya-tkani']){echo $_GET['attribute_pa_kategoriya-tkani'];}?>">
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
   <form id='product-colors'>
      <input type="hidden" name="product-ids" value="<?php the_ID(); ?>">
     <?php if($mattress):?>
      <input type="hidden" name="mattress-size" value="">
     <?php endif;?>
    </form>
    <div class="product__popup colors hidden">
        <div class="colors__close">&times;</div>
        <div class="listing hidden" data-size="big" id="result-colors" style="width:100%;"></div>
    </div>
    <?php if(!$aksessuary && !$services && $category->term_id != 118):?>
    <form id='product-pillar'>
      <?php
        $values = CFS()->get(get_term( $basic_cat, 'product_cat' )->slug.'-collection');
        foreach ( $values as $key => $label ) {
          echo '<input type="hidden" name="collection[]" value="'.$key.'">';
        }
      ?>
    </form>
    <div class="product__popup pillar hidden">
        <div class="pillar__close">&times;</div>
        <div class="listing hidden" data-size="big" id="result-pillar" style="width:100%;"></div>
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
	


<?php do_action( 'woocommerce_after_single_product' ); ?>