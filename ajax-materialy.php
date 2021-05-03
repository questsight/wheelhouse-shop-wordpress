<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
if($_GET['cat']){
  $cat="&cat=" . $_GET['cat'];
}
global $query_string;
query_posts($query_string.$cat.'&posts_per_page=-1');
if ($_REQUEST && !empty($_REQUEST)) {
	 go_filter();
}
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <a href="<?php the_permalink()?>" class="listing__item">
            <img class="listing__foto" src="<?php the_post_thumbnail_url();?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php the_title(); ?></div>
          </a>
          <?php endwhile; endif; ?>