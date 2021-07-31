<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' );?>

<form class="product__form variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <div class="product__form-scroll">
    
    <!--?php if(CFS()->get( 'basic-description' ) && !$_GET['color']): ?>
<div class="product__color">
    <div class="product__color-name">Basic<span> - </span></div>
	<div class="product__color-description"><!--?php echo CFS()->get( 'basic-description' );?></div>
</div>
<!--?php elseif($_GET['color']):?>
<div class="product__color">
    <div class="product__color-name"><!--?php echo $_GET['color'];?><span> - </span></div>
	<div class="product__color-description"><!--?php echo CFS()->get( 'color-description' );?></div>
</div>
<!--?php elseif(get_term( $product->category_ids[0], 'product_cat' )->slug == "v-nalichii"):?>
<div class="product__color" style="display: block;"><!--?php echo CFS()->get( 'color-description' );?></div>
<!--?php else:?>
<div class="product__color">
    <div class="product__color-name"><!--?php echo CFS()->get( 'colors' )[0]['color-name'];?><span> - </span></div>
	<div class="product__color-description"><!--?php echo CFS()->get( 'color-description' );?></div>
</div>
<!--?php endif;?-->
    
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<div class="variations">
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>

							<?php
							    $categories = get_the_terms( $post->ID, 'product_cat' );
							    $slug = false;
							    $aksessuary = false;
                  foreach ($categories as $category) {
                    if(CFS()->get( $category->slug . '-collection' )){
                      $slug = $category->slug;
                    }
                    if($category->slug == 'matrasy' || $category->slug == 'namatrasniki'){
                      $slug = $category->slug;
                      $aksessuary = true;
                      break;
                    }
                    if(get_ancestors($category->term_id,'product_cat')[0] == 33){
                      $aksessuary = true;
                      break;
                    }
                    if($category->slug == 'v-nalichii'){
                      $slug = $category->slug;
                      $aksessuary = true;
                      break;
                    }
                  }
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
										'input' => $input,
										'slug' => $slug,
                                        'aksessuary' =>$aksessuary,
									)
								);
								
							?>

				<?php endforeach;?>
		</div>
        <?php $heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );
            //do_action( 'woocommerce_product_additional_information', $product ); ?>
   
		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				//do_action( 'woocommerce_before_single_variation' );
				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
                do_action( 'woocommerce_single_variation' );
				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				//do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>
	<?php do_action( 'woocommerce_after_variations_form' ); ?>
        
    </div><br><br>
    <?php 
  //echo $product->post->post_content; 
    if(CFS()->get( 'deadline' )):?>
  <p><strong>Будет готово для Вас <?php echo date("d.m.Y", strtotime("+".CFS()->get( 'deadline' )." days"));?></strong></p><br>
<?php endif;?> 
    <button type="submit" class="ajax_add_to_cart single_add_to_cart_button button alt" ><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
    <p><img style="width: 15px;margin-right: 5px;margin-bottom: -2px;" src="/wp-content/themes/questsight/assets/images/unlock_01.png">Безопасная покупка через защищенный протокол SSL</p>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
