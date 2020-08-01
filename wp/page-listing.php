<?php
/*
Template Name: Listing
Template Post Type: page
*/
get_header();?>

        <div class="listing" <?php if(is_page('komanda-wh')){echo 'data-transform="none"';}?> <?php if(is_page('portfolio')){echo 'data-type="portfolio"';}?>>
          <?php
            $fields = CFS()->get( 'listing' );
            if( ! empty($fields) ):
            $item=1;
            foreach ( $fields as $field ){?>
          <div class="listing__item" data-item="<?php echo $item; ?>" data-description='<?php echo $field['description']; ?>'>
            <picture>
              <source srcset="<?php echo $field['image_webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['image_jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <?php if($field['title_all']):?>
            <div class="listing__title hidden"><?php echo $field['title_all']; ?>
            </div>
            <div class="listing__title"><?php echo $field['title']; ?>
            </div>
            <?php else:?>
            <div class="listing__title"><?php echo $field['title']; ?></div>
            <?php endif;?>
          </div>
          <?php $item++;} endif;?> 
          <div class="listing__popup hidden">
            <div class="listing__close">&times;</div>
            <div class="listing__arrow-left">&laquo;</div>
            <div class="listing__arrow-right">&raquo;</div>
            <div class="listing__popup-text">
              <div class="listing__popup-title"></div>
              <div class="listing__popup-description"></div>
            </div>
            <div class="listing__popup-foto"><img src="" alt="Студия авторской мебели WheelHouse"></div>
          </div>
        </div>


<?php get_footer();?>