<?php
/*
Template Name: Listing
Template Post Type: page
*/
get_header();?>

        <div class="listing" <?php if(is_page('komanda-wh')){echo 'data-transform="none"';}?> <?php if(in_array(24921, get_post_ancestors($post->ID)) || is_page('sertifikaty')){echo 'data-type="portfolio"';}?>>
          <?php
            $fields = CFS()->get( 'listing' );
            if( ! empty($fields) ):
			if(in_array('24921',get_ancestors( get_the_ID(), 'page' ))) $fields=array_reverse($fields);
            $item=1;
            foreach ( $fields as $field ){?>
          <div class="listing__item" data-item="<?php echo $item; ?>" data-description='<?php echo $field['description']; ?>'>
           <?php if(in_array(24921, get_post_ancestors($post->ID)) || is_page('sertifikaty')):
            $arr=array();
            foreach ( $field['image'] as $one ){
              $arr[] = $one['image_jpg'];
            }
            ?>
           <img class="listing__foto" src="<?php echo $field['image'][0]['image_jpg']; ?>" data-src="<?php echo implode(", ", $arr); ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
           <?php else:?>
            <img class="listing__foto" src="<?php echo $field['image_jpg']; ?>" data-src="<?php echo $field['image_jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <?php endif;?>
            <?php if(!is_page('sertifikaty')):?>
            <?php if($field['title_all']):?>
            <div class="listing__title hidden"><?php echo $field['title_all']; ?>
            </div>
            <div class="listing__title"><?php echo $field['title']; ?>
            </div>
            <?php else:?>
            <div class="listing__title"><?php echo $field['title']; ?></div>
            <?php endif;?>
            <?php endif;?>
          </div>
          <?php $item++;} endif;?> 
          <div class="listing__popup hidden" <?php if(is_page('sertifikaty')){echo 'style="justify-content:center;"';}?>>
            <div class="listing__close">&times;</div>
            <div class="listing__arrow-left">&laquo;</div>
            <div class="listing__arrow-right">&raquo;</div>
            <?php if(!is_page('sertifikaty')):?>
            <div class="listing__popup-text">
              <div class="listing__popup-title"></div>
              <div class="listing__popup-description"></div>
            </div>
            <?php endif;?> 
            <div class="listing__popup-foto" <?php if(is_page('sertifikaty')){echo 'style="width:auto;"';}?>><img src="" alt="Студия авторской мебели WheelHouse"></div>
          </div>
        </div>


<?php get_footer();?>