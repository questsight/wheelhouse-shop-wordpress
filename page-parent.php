<?php
/*
Template Name: Parent page
Template Post Type: page
*/
get_header();?>

        <div class="listing">
        <?php $stati_children = new WP_Query(array(
              'orderby' => 'date',
              'order' => 'ASC',
              'post_type' => 'page',
              'post_parent' => get_the_ID()
              ));
          if($stati_children->have_posts()) :
          while($stati_children->have_posts()): $stati_children->the_post();?>
          <a href="<?php the_permalink()?>" class="listing__item">
            <img class="listing__foto" src="<?php the_post_thumbnail_url(); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php the_title();?></div>
          </a>
          <?php endwhile; endif; wp_reset_query();?>
        </div>
<?php get_footer();?>