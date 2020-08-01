<?php
/*
Template Name: Questionnaire page
Template Post Type: page
*/
get_header();?>

<div class="text">
  <?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php endwhile; ?>
    <div class="text__button" data-questionnaire> <span>Заполнить анкету</span></div>
    <div class="questionnaire hidden">
        <div class="questionnaire__close">&times;</div>
        <?php echo do_shortcode('[contact-form-7 id="4937" title="Индивидуальный заказ"]');?>
    </div>
</div>

<?php get_footer();?>