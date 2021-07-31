<?php
get_header();
$args_d = array(
  'taxonomy' => 'product_cat',
  'child_of' => 22,
);
$product_categories_d = get_terms( $args_d );
$args_kr = array(
  'taxonomy' => 'product_cat',
  'child_of' => 23,
);
$product_categories_kr = get_terms( $args_kr );
$args_krd = array(
  'taxonomy' => 'product_cat',
  'child_of' => 24,
);
$product_categories_krd = get_terms( $args_krd );
?>
<div class="container">
<h1 class="subtitle">Детские кровати</h1>
    </div>
        <div class="listing">
        <?php 
          if(count($product_categories_krd)>0) :
          foreach($product_categories_krd as $product_category_krd):
          if($product_category_krd->name == 'Конфигуратор'):
          $thumbnail_id = get_woocommerce_term_meta( $product_category_krd->term_id, 'thumbnail_id', true );?>
          <a href="<?php echo get_term_link( $product_category_krd );?>" class="listing__item">
            <img class="listing__foto" src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php echo get_the_category_by_ID($product_category_krd->parent);?></div>
          </a>
          <?php endif; endforeach; endif; wp_reset_query();?>
        </div>

<div class="container"><hr>
<h1 class="subtitle">Кровати</h1>
    </div>
        <div class="listing">
        <?php 
          if(count($product_categories_kr)>0) :
          foreach($product_categories_kr as $product_category_kr):
          if($product_category_kr->name == 'Конфигуратор'):
          $thumbnail_id = get_woocommerce_term_meta( $product_category_kr->term_id, 'thumbnail_id', true );?>
          <a href="<?php echo get_term_link( $product_category_kr );?>" class="listing__item">
            <img class="listing__foto" src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php echo get_the_category_by_ID($product_category_kr->parent);?></div>
          </a>
          <?php endif; endforeach; endif; wp_reset_query();?>
        </div>

<div class="container"><hr>
<h1 class="subtitle">Диваны</h1>
</div>
        <div class="listing">
        <?php 
          if(count($product_categories_d)>0) :
          foreach($product_categories_d as $product_category_d):
          if($product_category_d->name == 'Конфигуратор'):
          $thumbnail_id = get_woocommerce_term_meta( $product_category_d->term_id, 'thumbnail_id', true );?>
          <a href="<?php echo get_term_link( $product_category_d );?>" class="listing__item">
            <img class="listing__foto" src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php echo get_the_category_by_ID($product_category_d->parent);?></div>
          </a>
          <?php endif; endforeach; endif; wp_reset_query();?>
        </div>
<?php get_footer();?>