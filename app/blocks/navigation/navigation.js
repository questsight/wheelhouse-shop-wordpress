jQuery( document ).ready( function() {
  jQuery('.navigation__call-buyer > a').on('click', function(){
    jQuery('#box-cooperation').addClass('hidden_type_min-md');
    jQuery('#box-contacts').addClass('hidden_type_min-md');
    jQuery('#box-buyer').removeClass('hidden_type_min-md');
    jQuery('html, body').animate({scrollTop: jQuery(document).height() - jQuery(window).height()}, 100);
    return false;
  });
  jQuery('.navigation__call-cooperation > a').on('click', function(){
    jQuery('#box-buyer').addClass('hidden_type_min-md');
    jQuery('#box-contacts').addClass('hidden_type_min-md');
    jQuery('#box-cooperation').removeClass('hidden_type_min-md');
    jQuery('html, body').animate({scrollTop: jQuery(document).height() - jQuery(window).height()}, 100);
    return false;
  });
  jQuery('.navigation__call-contacts > a').on('click', function(){
    jQuery('#box-buyer').addClass('hidden_type_min-md');
    jQuery('#box-cooperation').addClass('hidden_type_min-md');
    jQuery('#box-contacts').removeClass('hidden_type_min-md');
    jQuery('html, body').animate({scrollTop: jQuery(document).height() - jQuery(window).height()}, 100);
    return false;
  });
  jQuery('#navigation .navigation__list .menu-item-has-children').hover(function(){
    if ( window.matchMedia( '(min-width: 992px)' ).matches ) {
      var $images = jQuery('img',this);
      $images.each(function(){
        var $img = jQuery(this),
            src = $img.attr('data-src');
        jQuery($img).attr('src',src);
        jQuery($img).removeAttr('data-spai');
      });
    }
  });
  jQuery('#navigation .navigation__list .menu-item-has-children > a', this).on('click', function(){
    if ( window.matchMedia( '(min-width: 992px)' ).matches ) {
      return false;
    }
  });
});