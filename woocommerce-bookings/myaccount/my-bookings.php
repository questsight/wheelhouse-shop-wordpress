<?php
/**
 * My Bookings - Deprecated
 *
 * Shows bookings on the account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce-bookings/myaccount/my-bookings.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @version 1.9.10
 * @deprecated 1.10.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<br><br><h2 class="title">Встречи</h2><br>

<table class="shop_table my_account_bookings">
	<thead>
		<tr>
			<th scope="col" class="order-number">Заказ</th>
            <th scope="col" class="booked-product">Встреча</th>
            <th scope="col" class="booking-start-date">Дата и время</th>
			<th scope="col" class="booking-cancel"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $bookings as $booking ) : ?>
			<tr>
				<td class="order-number">
					<?php if ( $booking->get_order() ) : ?>
					<a href="<?php echo esc_url( $booking->get_order()->get_view_order_url() ); ?>">
						<?php echo "№".esc_html( $booking->get_order()->get_order_number() ); ?>
					</a>
					<?php endif; ?>
				</td>
				<td class="booked-product">
					<?php if ( $booking->get_product() && $booking->get_product()->is_type( 'booking' ) ) : ?>
					<a href="<?php echo esc_url( get_permalink( $booking->get_product()->get_id() ) ); ?>">
						<?php echo esc_html( $booking->get_product()->get_title() ); ?>
					</a>
					<?php endif; ?>
				</td>
              <td class="booking-start-date"><?php echo esc_html( $booking->get_start_date( null, null, wc_should_convert_timezone( $booking ) ) ); ?></td>
				<td class="booking-cancel">
					<?php if ( $booking->get_status() !== 'cancelled' && $booking->get_status() !== 'completed' && ! $booking->passed_cancel_day() ) : ?>
					<!--a href="<!--?php echo esc_url( $booking->get_cancel_url() ); ?>" class="button cancel">Отменить встречу</a><br-->
                    Если Вы хотите перенести или отменить встречу, обратитесь к <a target="_blank" rel="noopener noreferrer" href="https://wa.me/79299758419">менеджеру</a>
                    <?php elseif($booking->get_status() == 'cancelled'): ?>
                    Встреча отменена
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
