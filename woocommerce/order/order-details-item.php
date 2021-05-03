<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<div class="cart__item <?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">
    <div class="catr__product">
    <?php
    $is_visible        = $product && $product->is_visible();
        if ($item['link']){
            $product_permalink = $item['link'];
        }else{
            $product_permalink = strtok(apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order ), '?');
        }
        if ($item['img']){
            $thumbnail = '<img width="450" height="300" src="'.$item['img'].'" class="aattachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy">';
        }else{
            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product->get_image() );  
        }
		if ( ! $product_permalink || $product->id == 25083) {
			echo $thumbnail; // PHPCS: XSS ok.
		} else {
			printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
		}
        if ($item['color']){
            $prName = $item->get_name() . '&nbsp;' .$item['color'];
        }else{
            $prName = $item->get_name();
        }
	?>
    </div>
    <div class="cart__description">
	<div class="woocommerce-table__product-name product-name cart__title">
		<?php
		$is_visible        = $product && $product->is_visible();

	 echo '<p>'.apply_filters( 'woocommerce_order_item_name', $product->id != 25083  && $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $prName ) : $item->get_name(), $item, $is_visible ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


		$qty          = $item->get_quantity();
		$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

		if ( $refunded_qty ) {
			$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
		} else {
			$qty_display = esc_html( $qty );
		}

		echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $qty_display ) . '</strong>', $item .'</p>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		//do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
        echo "<div class='cart__meta'>";
      wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo "</div>";
		//do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
		?>
	</div>

	<div class="woocommerce-table__product-total product-total cart__price">
		<?php echo $order->get_formatted_line_subtotal( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
    </div>
</div>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>

</tr>

<?php endif; ?>
