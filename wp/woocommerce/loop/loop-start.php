<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="listing" <?php if(!is_shop()&&!is_product()&&!is_product_category('aksessuary')){echo 'data-size="big"';} if(!is_shop()&&!is_product()&&!is_product_category('superczena')&&!check_if_category_has_child(get_queried_object())){echo 'data-box="box" id="result-product"';} if(is_product()){echo 'data-related';}?>>