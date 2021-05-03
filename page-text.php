<?php
/*
Template Name: Text page
Template Post Type: page
*/
get_header();?>
<div class="text">
<?php while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; ?>
</div>
<?php get_footer();?>