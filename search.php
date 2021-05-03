<?php get_header(); ?>

        <div class="listing">
        <?php while ( have_posts() ) : the_post(); if(get_post_type()!="attachment"):?>
         
          <a href="<?php the_permalink()?>" class="listing__item">
            <img class="listing__foto" src="<?php the_post_thumbnail_url(); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php the_title();?></div>
          </a>
        <?php endif;endwhile;?>
        </div>

<?php get_footer(); ?>
