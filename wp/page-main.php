<?php get_header();?>

        <div class="main">
          <picture>
            <source srcset="<?php echo get_field('main-webp'); ?>" type="image/webp"><img class="main__background-image" src="<?php echo get_field('main-img'); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
          </picture>
          <div class="main__name">
            <picture>
              <source srcset="<?php echo get_field('name-webp'); ?>" type="image/webp"><img class="main__name-image" src="<?php echo get_field('name-img'); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <h1 class="title"><?php echo get_bloginfo('description'); ?></h1>
          </div>
        </div>

<?get_footer();?>