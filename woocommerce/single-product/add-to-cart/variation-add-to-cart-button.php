<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
<?php if((has_term( 'krovati', 'product_cat' ) || has_term( 'detskie-krovati', 'product_cat' )) && !CFS()->get( 'add-more' )):?>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" id="product__mattress" data-price="0">Добавить матрас</div>
    <div class="product__delete hidden" id="del-mattress">&times;</div>
</div>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" id="product__namatrasniki"  data-price="0">Добавить наматрасник</div>
    <div class="product__delete hidden" id="del-namatrasniki">&times;</div>
</div>
<?php endif;?>
<?php if(has_term( 'detskie-krovati', 'product_cat' ) && !CFS()->get( 'add-more' )):?>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" id="product__chehly-na-matras"  data-price="0">Добавить чехол на матрас</div>
    <div class="product__delete hidden" id="del-chehly-na-matras">&times;</div>
</div>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" id="product__pokryvala"  data-price="0">Добавить покрывало</div>
    <div class="product__delete hidden" id="del-pokryvala">&times;</div>
</div>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" id="product__podushki"  data-price="0">Добавить подушки</div>
    <div class="product__delete hidden" id="del-podushki">&times;</div>
</div>
<?php endif;?>
<?php $fields = CFS()->get( 'mattress' ); if(!empty($fields)):?>
  <div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" data-fix=1 id="product__mattress"  data-price="0">Выбрать матрас</div>
  </div>
<?php endif;?>
<br><div class="description" id="description"><?php echo $product->post->post_content; if(CFS()->get( 'deadline' )):?>
  <br><p><strong>Будет готово для Вас <?php echo date("d.m.Y", strtotime("+".CFS()->get( 'deadline' )." days"));?></strong></p><br>
<?php endif;?> 
<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	<button type="submit" class="ajax_add_to_cart single_add_to_cart_button button alt" ><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
	<?php $fields = CFS()->get( 'mattress' ); if(has_term( 'krovati', 'product_cat' ) || has_term( 'detskie-krovati', 'product_cat' ) || !empty($fields)):?>
	<input id="add-mattress" type="hidden"/>
	<?php endif;?>
  <?php if(has_term( 'krovati', 'product_cat' ) || has_term( 'detskie-krovati', 'product_cat' )):?>
	<input id="add-namatrasniki" type="hidden"/>
	<?php endif;?>
  <?php if(has_term( 'detskie-krovati', 'product_cat' )):?>
  <input id="add-chehly-na-matras" type="hidden"/>
  <input id="add-pokryvala" type="hidden"/>
	<?php endif;?>
</div>
