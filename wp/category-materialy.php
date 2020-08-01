<?php get_header();?>

        <div class="listing">
        <?php $stati_children = get_categories([
              'taxonomy'     => 'category',
              'hide_empty' => '1',
              'parent' => '34',
              'orderby' => 'term_id',
              'order' => 'ASC',
              ]);
          if($stati_children){
          foreach($stati_children as $cat){?>
          <a href="<?php echo get_category_link( $cat->term_id );?>" class="listing__item">
            <img loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>" class="listing__foto" src="<?php echo wp_get_attachment_image_url(get_term_meta($cat->term_id, 'id-cat-images', true), 'full');?>">
            <div class="listing__title"><?php echo $cat->name;?></div>
          </a>
          <?php }} wp_reset_query();?>
        </div>
<?php get_footer();?>