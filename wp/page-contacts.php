<?php
/*
Template Name: Contacts
Template Post Type: page
*/
get_header();?>

        <div class="contacts">
          <div class="contacts__map hidden_type_min-sm">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A3dd8f730af7107d055166edc322ffd9c8c42b74c7056c920491ff56cc4a3bd7f&amp;amp;source=constructor" width="100%" height="450" frameborder="0"></iframe>
          </div>
          <div class="contacts__text">
            <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
          </div>
          <div class="contacts__map hidden_type_max-sm">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aee0e05020650f3338a268c55a1d8ed1abd0400d046cbaf27e2780012665d74f7&amp;amp;source=constructor" width="100%" height="350" frameborder="0"></iframe>
          </div>
        </div>

<?php get_footer();?>