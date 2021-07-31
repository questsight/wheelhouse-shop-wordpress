<!DOCTYPE html>
<html lang = "ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <link rel="preload" href="/wp-content/themes/questsight/assets/fonts/geometria-regular.woff2" as="font" crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/questsight/assets/fonts/geometria-bold.woff2" as="font" crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/questsight/assets/fonts/geometria-medium.woff2" as="font" crossorigin="anonymous">
    <?php wp_head(); ?>
  </head>
  <body class="body">
    <div class="site">
      <header class="site__header header">
        <?php the_custom_logo();?>
        <div class="hamburger" id="hamburger">
          <div class="hamburger__item"></div>
          <div class="hamburger__item"></div>
          <div class="hamburger__item"></div>
        </div>
        <div class="header__call hidden_type_min-md" data-popup="callback"><span class="icon-phone"></span><span>Oбратная связь</span></div>
        <a class="header__contact hidden_type_min-md" href="tel:<?php $empty = array(" ", "(", ")","-"); $phone = str_replace($empty, "", get_theme_mod('example_phone', '')); echo $phone; ?>"><?php echo get_theme_mod('example_phone', ''); ?></a>
        <?php global $woocommerce; ?>
        <a class="header__icon hidden_type_max-md" href="https://www.facebook.com/wheelhousedesign.ru/" target="_blank"><span class="icon-facebook-official"></span></a><a class="header__icon hidden_type_max-md" href="https://www.instagram.com/wheelhousedesign.ru" target="_blank"><span class="icon-instagram"></span></a>
        <div class="header__icon hidden_type_max-md" data-popup="callback"><span class="icon-phone"></span></div>
        <form class="header__form" id="form-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="search" value="<?php the_search_query(); ?>" name="s">
        </form>
        <div class="header__icon" id="icon-search"><span class="icon-search"></span></div><a class="header__icon" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><span class="icon-shopping-cart"></span></a><a class="header__icon" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><span class="icon-user"></span></a>
      </header>
      <nav class="navigation site__navigation hidden_type_min-md" id="navigation">
        <?php the_custom_logo();
          $nav = wp_nav_menu( array(
            'theme_location' => 'header',
            'container'      => false,
            'menu_class'     => 'navigation__list',
            'echo' => false
          ) );
          $nav = str_replace('src=', 'src="'.get_site_url().'/wp-content/themes/questsight/assets/plug.gif" data-src=',$nav);
          echo $nav;
        ?>
      </nav> 
      <div class="site__content content">