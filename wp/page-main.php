<?php
/*
Template Name: Main page
Template Post Type: page
*/
get_header();?>

        <div class="main">
          <img class="main__background-image" src="<?php echo CFS()->get( 'background-image' ); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
          <div class="main__name">
            <img class="main__name-logo" src="<?php echo CFS()->get('name-logo'); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <img class="main__name-image" src="<?php echo CFS()->get('name-image'); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <h1 class="main__name-title"><?php echo get_bloginfo('description'); ?></h1>
          </div>
        </div>

<?php get_footer();?>