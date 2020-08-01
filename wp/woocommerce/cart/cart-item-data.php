<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-item-data.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="cart__meta">
	<?php foreach ( $item_data as $data ) :
	    if($data['display'] != 'false' && $data['key'] != "категория ткани"):
	        $key = str_replace("Выбрать", "", $data['key']);
	        $key = str_replace("выбрать", "", $key);?>
		<div class="cart__meta-title <?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo $key; if($data['display'] != 'true'):?>:
		<span class="<?php echo sanitize_html_class( 'variation-' . $data['key'] ); ?>"><?php echo $data['display']; ?></span><?php endif;?></div>
	<?php endif; endforeach; ?>
</div>
