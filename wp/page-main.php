<?php
/*
Template Name: Main page
Template Post Type: page
*/
get_header();?>

        <div class="main">
          <picture>
            <source srcset="<?php echo CFS()->get( 'background-image_webp' ); ?>" type="image/webp"><img class="main__background-image" src="<?php echo CFS()->get( 'background-image' ); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
          </picture>
          <div class="main__name">
            <picture>
              <source srcset="<?php echo CFS()->get('name-logo_webp'); ?>" type="image/webp"><img class="main__name-logo" src="<?php echo CFS()->get('name-logo'); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <picture>
              <source srcset="<?php echo CFS()->get('name-image_webp'); ?>" type="image/webp"><img class="main__name-image" src="<?php echo CFS()->get('name-image'); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <h1 class="main__name-title"><?php echo get_bloginfo('description'); ?></h1>
          </div>
        </div>

<?php get_footer();?>