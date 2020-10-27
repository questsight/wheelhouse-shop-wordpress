      </div>
      <section class="site__submenu submenu">
        <div class="submenu__box hidden_type_min-md" id="box-buyer">
          <h2 class="submenu__title">Покупателям</h2>
          <?php
            wp_nav_menu( array(
              'theme_location' => 'footer-left',
              'container'      => false,
              'menu_class'     => 'submenu__list',
            ) );
          ?>
        </div>
        <div class="submenu__box hidden_type_min-md" id="box-cooperation">
          <h2 class="submenu__title">Сотрудничество</h2>
          <?php
            wp_nav_menu( array(
              'theme_location' => 'footer-center',
              'container'      => false,
              'menu_class'     => 'submenu__list',
            ) );
          ?>
        </div>
        <div class="submenu__box hidden_type_min-md" id="box-contacts">
          <h2 class="submenu__title">Контакты</h2>
          <a class="submenu__phone" href="tel:<?php $empty = array(" ", "(", ")","-"); $phone = str_replace($empty, "", get_theme_mod('example_phone', '')); echo $phone; ?>"><?php echo get_theme_mod('example_phone', ''); ?></a>
          <div class="submenu__time"><?php echo get_theme_mod('example_time', ''); ?></div>
          <?php
            wp_nav_menu( array(
              'theme_location' => 'footer-right',
              'container'      => false,
              'menu_class'     => 'submenu__list',
            ) );
          ?>
        </div>
      </section>
      <footer class="site__footer footer">
        <div class="footer__item hidden_type_min-md">
          <div class="footer__call" data-popup="callback"><span class="icon-phone"></span><span>Oбратная связь</span></div>
        </div>
        <div class="footer__item hidden_type_min-md"><a class="footer__social" href="https://www.instagram.com/wheelhousedesign.ru" target="_blank"><span class="icon-instagram"></span><span>wheelhousedesign.ru</span></a></div>
        <div class="footer__item hidden_type_min-md"><a class="footer__social" href="https://www.facebook.com/katerina.v.ushakova/" target="_blank"><span class="icon-facebook-official"></span><span>wheelhousedesign.ru</span></a></div>
        <?php
            wp_nav_menu( array(
              'theme_location' => 'footer-mobile',
              'container'      => false,
              'menu_class'     => 'footer__list hidden_type_max-md',
            ) );
          ?>
      </footer>
      <div class="popup hidden" id="callback">
        <div class="popup__content">
          <div class="popup__exit">&times;</div>
          <?php echo do_shortcode('[contact-form-7 id="211" title="Обратный звонок"]'); ?>
        </div>
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>