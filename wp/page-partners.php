<?php
/*
Template Name: Partners
Template Post Type: page
*/
get_header();?>

        <div class="listing">
          <?php
            $fields = CFS()->get( 'listing' );
            if( ! empty($fields) ):
            foreach ( $fields as $field ){
          if($field['link']){?>
          <a href="<?php echo $field['link']; ?>" class="partner">
             <picture>
              <source srcset="<?php echo $field['image_webp']; ?>" type="image/webp"><img src="<?php echo $field['image_jpg']; ?>" loading="lazy" alt="<?php echo $field['title']; ?>">
            </picture>
          </a>
          <?php }else{?>
          <div class="partner">
             <picture>
              <source srcset="<?php echo $field['image_webp']; ?>" type="image/webp"><img src="<?php echo $field['image_jpg']; ?>" loading="lazy" alt="<?php echo $field['title']; ?>">
            </picture>
          </div>
          <?php } } endif;?> 
        </div>


<?php get_footer();?>