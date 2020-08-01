<?php get_header();?>
        <h1 class="title"><?php the_title();?></h1>
        <div class="description"><?php while (have_posts()) : the_post(); the_content(); endwhile; ?></div>
        <div class="listing">
          <?php
            $fields = CFS()->get( 'palette' );
            if( ! empty($fields) ):
            $item=1;
            foreach ( $fields as $field ){?>
          <div class="listing__item" data-item="<?php echo $item; ?>" data-description="<?php echo $field['description']; ?>">
            <picture>
              <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title"><?php echo $field['name-color']; ?></div>
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