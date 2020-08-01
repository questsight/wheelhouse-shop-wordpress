jQuery( document ).ready( function() {
  var calc = jQuery(".listing__item").length;
  var item = 0;
  jQuery( '.listing__item' ).click( function() {
    if( window.matchMedia( '(max-width: 767px)' ).matches) {
      jQuery('.listing__item').addClass('hidden');
      jQuery('.description').addClass('hidden');
      jQuery('.title').addClass('hidden');
    }
    if( window.matchMedia( '(min-width: 992px)' ).matches & jQuery(".listing").height() > jQuery(window).height() - 160) {
      jQuery(".listing").attr("data-fixed","fixed");
    } else if(jQuery(".listing").height() > jQuery(window).height() - jQuery(".site__header").height() - 50 ){
      jQuery(".listing").attr("data-fixed","fixed");
    };
    jQuery('.listing__popup-foto img').attr('src', jQuery(this).children('picture').children('.listing__foto').attr('src'));
    jQuery('.listing__popup-title').html(jQuery(this).children('.listing__title').html());
    jQuery('.listing__popup-description').html(jQuery(this).attr('data-description'));
    item = +jQuery(this).attr('data-item');
    jQuery( '.listing__popup' ).removeClass('hidden');
  });
  jQuery( '.listing__arrow-left' ).click( function () {
    if(item == 1){
      item = calc;
    } else {
      item--;
    }
    jQuery('.listing__popup-title').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').children('.listing__title').html());;
    jQuery('.listing__popup-description').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').attr('data-description'));
    jQuery('.listing__arrow-left').addClass('animation-opacity-0');
    jQuery('.listing__arrow-right').addClass('animation-opacity-0');
    jQuery('.listing__popup-foto img').addClass('animation-opacity-0').attr('src', jQuery('[data-item="'+item+'"]').children('picture').children('.listing__foto').attr('src')).on("load", function() {
      jQuery('.listing__popup-foto img').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__popup-title').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__popup-description').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__arrow-left').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__arrow-right').removeClass('animation-opacity-0').addClass('animation-opacity');
      setTimeout(function() {
        jQuery('.listing__popup-foto img').removeClass('animation-opacity');
        jQuery('.listing__popup-title').removeClass('animation-opacity');
        jQuery('.listing__popup-description').removeClass('animation-opacity');
        jQuery('.listing__arrow-left').removeClass('animation-opacity');
        jQuery('.listing__arrow-right').removeClass('animation-opacity');
      }, 1000);
    })
    return false;
	});
  jQuery( '.listing__arrow-right' ).click( function () {
    if(item == calc) {
      item = 1;
    } else {
      item++;
    }
    jQuery('.listing__popup-title').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').children('.listing__title').html());;
    jQuery('.listing__popup-description').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').attr('data-description'));
    jQuery('.listing__arrow-left').addClass('animation-opacity-0');
    jQuery('.listing__arrow-right').addClass('animation-opacity-0');
    jQuery('.listing__popup-foto img').addClass('animation-opacity-0').attr('src', jQuery('[data-item="'+item+'"]').children('picture').children('.listing__foto').attr('src')).on("load", function() {
      jQuery('.listing__popup-foto img').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__popup-title').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__popup-description').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__arrow-left').removeClass('animation-opacity-0').addClass('animation-opacity');
      jQuery('.listing__arrow-right').removeClass('animation-opacity-0').addClass('animation-opacity');
      setTimeout(function() {
        jQuery('.listing__popup-foto img').removeClass('animation-opacity');
        jQuery('.listing__popup-title').removeClass('animation-opacity');
        jQuery('.listing__popup-description').removeClass('animation-opacity');
        jQuery('.listing__arrow-left').removeClass('animation-opacity');
        jQuery('.listing__arrow-right').removeClass('animation-opacity');
    }, 1000);
      
    });
    return false;
	});
  jQuery( '.listing__close' ).click( function() {
    jQuery( '.listing__popup' ).addClass('hidden');
    jQuery('.listing__item').removeClass('hidden');
    jQuery('.description').removeClass('hidden');
    jQuery('.title').removeClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery( '.listing__popup' ).addClass('hidden'); 
    }
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 37){
      jQuery('.listing__arrow-left').click();
    }
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 39){
      jQuery('.listing__arrow-right').click();
    }
  });
});
var lastX;
jQuery(document).bind('touchmove', function (e){
  var currentX = e.originalEvent.touches[0].clientX;
  if(currentX > lastX){
    jQuery('.listing__arrow-left').click();
  }else if(currentX < lastX){
    jQuery('.listing__arrow-right').click();
  }
  lastX = currentX;
});