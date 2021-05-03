<?php
get_header();
$args = array(
  'taxonomy' => 'product_cat',
);
$product_categories = get_terms( $args );
?>

        <div class="listing">
        <?php 
          if(count($product_categories)>0) :
          foreach($product_categories as $product_category):
          if($product_category->name == 'Конфигуратор'):
          $thumbnail_id = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true );?>
          <a href="<?php echo get_term_link( $product_category );?>" class="listing__item">
            <img class="listing__foto" src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php echo get_the_category_by_ID($product_category->parent);?></div>
          </a>
          <?php endif; endforeach; endif; wp_reset_query();?>
        </div>
<?php get_footer();?>