<!DOCTYPE html>
<html lang = "ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <div class="header__call hidden_type_min-md" data-popup="callback"><i class="fa fa-phone fa-lg" aria-hidden="true"></i><span>Oбратная связь</span></div>
        <a class="header__contact hidden_type_min-md" href="tel:<?php $empty = array(" ", "(", ")","-"); $phone = str_replace($empty, "", get_theme_mod('example_phone', '')); echo $phone; ?>"><?php echo get_theme_mod('example_phone', ''); ?></a>
        <?php global $woocommerce; ?>
        <a class="header__icon hidden_type_max-md" href="https://www.facebook.com/katerina.v.ushakova/" target="_blank"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a><a class="header__icon hidden_type_max-md" href="https://www.instagram.com/wheelhousedesign.ru" target="_blank"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
        <div class="header__icon hidden_type_max-md" data-popup="callback"><i class="fa fa-phone fa-lg" aria-hidden="true"></i></div>
        <form class="header__form" id="form-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="search" value="<?php the_search_query(); ?>" name="s">
        </form>
        <div class="header__icon" id="icon-search"><i class="fa fa-search fa-lg" aria-hidden="true"></i></div><a class="header__icon" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a><a class="header__icon" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fa fa-user fa-lg" aria-hidden="true"></i></a>
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