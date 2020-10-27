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

do_action( 'woocommerce_before_add_to_cart_form' );
if(CFS()->get( 'color-name' )):?>
<div class="product__color">
    <div class="product__color-name"><?php echo CFS()->get( 'color-name' );?><span> - </span></div>
	<div class="product__color-description"><?php echo CFS()->get( 'color-description' );?></div>
</div>
<?php endif;?>
<form class="product__form variations_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<div class="variations">
			<?php $storage=0; $other=0; foreach ( $attributes as $attribute_name => $options ) : ?>

							<?php
							    if(in_array('false',$options)){
							        $input++;
							        if(strpos($attribute_name, "storage") != false){
							            $storage++;
							        }else{
							            $other++;
							        }
							    }
							    $categories = get_the_terms( $post->ID, 'product_cat' );
							    $slug = false;
							    
                                foreach ($categories as $category) {
                                    if($category->slug == 'pokryvala'){
                                        $slug = $category->slug;
                                        break;
                                    }
                                    if($category->slug == 'matrasy'){
                                        $slug = $category->slug;
                                        break;
                                    }
                                }
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
										'input' => $input,
										'storage' => $storage,
										'other' => $other,
										'slug' => $slug,
										'fixchoice' => CFS()->get( 'fix-choice' ),
									)
								);
								
							?>

				<?php endforeach;
				if($storage > 0 || $other > 0){echo "</div></div></div>";}?>
		</div>
        <?php $heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );
            do_action( 'woocommerce_product_additional_information', $product ); ?>
        <div class="description"><?php echo $product->post->post_content;?></div>
		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

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
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
