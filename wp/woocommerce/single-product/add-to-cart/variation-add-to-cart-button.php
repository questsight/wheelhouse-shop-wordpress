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
$categories = get_the_terms( $post->ID, 'product_cat' );
      $mattress = false;
      $kr = false;
      foreach ($categories as $category) {
        if($category->term_id == 148){
          $mattress = true;
          break;
        }elseif($category->term_id == 23 || $category->term_id == 24){
          $kr = true;
          break;
        }
      }
?>
<div class="woocommerce-variation-add-to-cart variations_button">
<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<?php if($kr):?>
<div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" id="product__mattress">Добавить матрас</div>
  </div>
<?php endif;?>
<?php $fields = CFS()->get( 'mattress' ); if(!empty($fields)):?>
  <div class="product__variation">
    <div class="product__variation-text"></div>
    <div class="product__variation-choice" data-fix=1 id="product__mattress">Выбрать матрас</div>
  </div>
<?php endif;?>
<br><div class="description"><?php echo $product->post->post_content;?></div>  
<?php
if(!$mattress):?>
	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
<?php endif;?>
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
	<input id="add-mattress" type="hidden"/>
</div>

