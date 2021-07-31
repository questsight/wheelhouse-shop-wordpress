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
<p class="wc-pao-addon-name">Добавить аксессуары</p><br>


<div class="product__variation wc-pao-addon-image-swatch add" title="Добавить матрас">
  <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( 148, 'thumbnail_id', true ) );?>" alt="Добавить матрас" width="65" style="margin:10px 0;" id="product__mattress" data-price="0">
</div>  
<div class="product__variation wc-pao-addon-image-swatch add" title="Добавить наматрасник">
  <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( 193, 'thumbnail_id', true ) );?>" alt="Добавить наматрасник" width="65" style="margin:10px 0;" id="product__namatrasniki" data-price="0">
</div>   
<!--div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" >Добавить матрас</div>
    <div class="product__delete hidden" id="del-mattress">&times;</div>
</div>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice"  data-price="0">Добавить наматрасник</div>
    <div class="product__delete hidden" id="del-namatrasniki">&times;</div>
</div-->
<?php endif;?>
<?php if(has_term( 'detskie-krovati', 'product_cat' ) && !CFS()->get( 'add-more' )):?>
<div class="product__variation wc-pao-addon-image-swatch add" title="Добавить чехол на матрас">
  <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( 195, 'thumbnail_id', true ) );?>" alt="Добавить мебельный чехол на матрас" width="65" style="margin:10px 0;" id="product__chehly-na-matras" data-price="0">
</div>
<div class="product__variation wc-pao-addon-image-swatch add" title="Добавить покрывало">
  <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( 159, 'thumbnail_id', true ) );?>" alt="Добавить покрывало" width="65" style="margin:10px 0;" id="product__pokryvala" data-price="0">
</div>
<div class="product__variation wc-pao-addon-image-swatch add" title="Добавить подушки">
  <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( 158, 'thumbnail_id', true ) );?>" alt="Добавить подушки" width="65" style="margin:10px 0;" id="product__podushki" data-price="0">
</div>  
  
  
  
<!--div class="product__variation">
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
</div-->
<?php endif;?>
<?php $fields = CFS()->get( 'mattress' ); if(!empty($fields)):?>
  <div class="product__variation wc-pao-addon-image-swatch add" title="Выбрать матрас">
  <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( 148, 'thumbnail_id', true ) );?>" alt="Выбрать матрас" width="65" style="margin:10px 0;" data-fix=1 id="product__mattress" data-price="0">
</div> 
  
  <!--div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice"  data-price="0">Выбрать матрас</div>
  </div-->
<?php endif;?>
<br>
<div class="description" id="description">
<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	
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
</div></div>
