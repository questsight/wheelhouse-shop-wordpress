<!DOCTYPE html>
<html lang="ru-RU">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
  </head>
  <body class="body">
    <div class="site">
      <header class="site__header header"><a href="<?php echo get_site_url();?>">
          <picture>
            <source srcset="<?php echo get_site_url();?>/wp-content/uploads/2019/09/logo.webp" type="image/webp"><img class="header__logo" src="<?php echo get_site_url();?>/wp-content/uploads/2019/09/logo.png" loading="lazy" alt="Студия авторской мебели WheelHouse">
          </picture></a>
        <nav class="navigation">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'header',
            'container'      => false,
            'menu_class'     => 'navigation__list',
          ) );
        ?>
        </nav>
      </header>
      <div class="site__content content">