<?php
/**
 * Booking product add to cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce-bookings/single-product/add-to-cart.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/bookings-templates/
 * @author  Automattic
 * @version 1.10.0
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

$nonce = wp_create_nonce( 'find-booked-day-blocks' );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<noscript><?php esc_html_e( 'Your browser must support JavaScript in order to make a booking.', 'woocommerce-bookings' ); ?></noscript>

<form class="cart booking__form" method="post" enctype='multipart/form-data' data-nonce="<?php echo esc_attr( $nonce ); ?>">

	<div id="wc-bookings-booking-form" class="wc-bookings-booking-form product__gallery">

		<?php do_action( 'woocommerce_before_booking_form' ); ?>

		<?php $booking_form->output(); ?>
<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( is_callable( array( $product, 'get_id' ) ) ? $product->get_id() : $product->id ); ?>" class="wc-booking-product-id" />

	<button type="submit" class="a-button wc-bookings-booking-form-button single_add_to_cart_button button alt disabled" style="display:none"><?php echo CFS()->get( 'button' );?></button>
	</div>
    <div class="product__description">
    <h1 class="product__title"><?php the_title();?></h1>
    <p class="product__price price"><?php echo str_replace(['From',':'], "", $product->get_price_html());?></p>
	<?php echo $product->post->post_content; do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </div>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' );  ?>
