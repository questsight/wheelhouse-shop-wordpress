<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

//do_action( 'woocommerce_before_cart' ); ?>
<div class="shop cart">
<form class="shop__main woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php //do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="shop_table shop_table_responsive woocommerce-cart-form__contents">
			<?php //do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                if(has_term( 'matrasy', 'product_cat',$cart_item['product_id'] ) || has_term( 'namatrasniki', 'product_cat',$cart_item['product_id'] )){
                    $mattress = true;
                }else{
                    $mattress = false;
                }
                if (array_key_exists("color",$cart_item)&&$cart_item['color']){
                    $prName = $_product->get_name() . '&nbsp;' .$cart_item['color'];
                }else{
                    $prName = $_product->get_name();
                }
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    if (array_key_exists("link",$cart_item)&&$cart_item['link']){
                        $product_permalink = $cart_item['link'];
                    }else{
                        $product_permalink = strtok(apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ), '?');
                    }

					?>
					<div class="cart__item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
            <div class="catr__product product-thumbnail">
						<?php
                        if (array_key_exists("img",$cart_item)&&$cart_item['img']){
                            $thumbnail = '<img width="450" height="300" src="'.$cart_item['img'].'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy">';
                        }else{
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );   
                        }
						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</div>
            <div class="cart__description">
              <div class="cart__title product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						  <?php
						  if ( ! $product_permalink ) {
							 echo '<p>'.wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $prName, $cart_item, $cart_item_key ) . '&nbsp;' ).'</p>';
						  } else {
							 echo '<p>'.wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $prName ), $cart_item, $cart_item_key ) ).'</p>';
						  }
						  do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
						  // Meta data.
              if(!$mattress){
                echo wc_get_formatted_cart_item_data( $cart_item );
              }
                echo '<br>';// PHPCS: XSS ok. 
						  // Backorder notification.
						  if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						  }
						  ?>
						  </div>             
            <div class="cart__count product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}
                        if(!$_product->is_type('booking')){
                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                        }
						?>
						</div> 
              <div class="cart__price product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						  </div>
              <div class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="cart__remove remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Удалить</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
						  ?>
						  </div>
            </div>
					</div>
					<?php
				}
			}
			?>

			<?php //do_action( 'woocommerce_cart_contents' ); ?>

			<div>

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button hidden" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			</div>

			<?php //do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>
	<?php //do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="shop__sidebar cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
