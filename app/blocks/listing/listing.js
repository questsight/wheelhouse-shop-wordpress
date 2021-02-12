jQuery( document ).ready( function() {
  var calc = jQuery(".listing__item").length;
  var item = 0;
  if(jQuery('.listing').attr('data-type')=='portfolio'){
    var portfolio = true;
  }else{var portfolio = false;}
  jQuery( '.listing__item' ).click( function() {
    jQuery(".portfolio__img").remove();
    jQuery('.listing__popup-foto img:first').attr('style', '');
    if( window.matchMedia( '(max-width: 767px)' ).matches) {
      jQuery('.listing__item').addClass('hidden');
      jQuery('.description').addClass('hidden');
      jQuery('.title').addClass('hidden');
    }
    if(portfolio){
      var stuff = jQuery(this).children('.listing__foto').attr('data-src').split(',');
    }
    if( window.matchMedia( '(min-width: 992px)' ).matches & jQuery(".listing").height() > jQuery(window).height() - 160 || window.matchMedia( '(min-width: 992px)' ).matches & jQuery(window).height()<700) {
      jQuery(".listing").attr("data-fixed","fixed");
    } else if(jQuery(".listing").height() > jQuery(window).height() - jQuery(".site__header").height() - 50){
      jQuery(".listing").attr("data-fixed","fixed");
    };
    if(portfolio){
      jQuery('.listing__popup-foto img').attr('src', stuff[0]);
      if(stuff.length > 1){
        jQuery('.listing__popup-foto img:first').css('max-height','calc(100vh - 200px)');
        jQuery.each(stuff,function(index,value){
          jQuery('.listing__popup-foto').append('<img class="portfolio__img" src="'+value+'" style="height:80px;margin: 5px;cursor:pointer;">');
        });
        jQuery(".portfolio__img").on('click', function(){
          jQuery('.listing__popup-foto img:first').attr('src',jQuery(this).attr('src'));
        });
      }
    }else{
      jQuery('.listing__popup-foto img').attr('src', jQuery(this).children('.listing__foto').attr('data-src'));
    }
    jQuery('.listing__popup-title').html(jQuery(this).children('.listing__title').html());
    jQuery('.listing__popup-description').html(jQuery(this).attr('data-description'));
    item = +jQuery(this).attr('data-item');
    jQuery( '.listing__popup' ).removeClass('hidden');
  });
  jQuery( '.listing__arrow-left' ).click( function () {
    jQuery(".portfolio__img").remove();
    jQuery('.listing__popup-foto img:first').attr('style', '');
    if(item == 1){
      item = calc;
    } else {
      item--;
    }
    var stuff = jQuery('[data-item="'+item+'"]').children('.listing__foto').attr('data-src').split(',');
    jQuery('.listing__popup-title').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').children('.listing__title').html());;
    jQuery('.listing__popup-description').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').attr('data-description'));
    jQuery('.listing__arrow-left').addClass('animation-opacity-0');
    jQuery('.listing__arrow-right').addClass('animation-opacity-0');
    if(portfolio){
      var foto0 = stuff[0];
      if(stuff.length > 1){
        jQuery('.listing__popup-foto img:first').css('max-height','calc(100vh - 200px)');
        jQuery.each(stuff,function(index,value){
          jQuery('.listing__popup-foto').append('<img class="portfolio__img" src="'+value+'" style="height:80px;margin: 5px;cursor:pointer;">');
        });
        jQuery(".portfolio__img").on('click', function(){
          jQuery('.listing__popup-foto img:first').attr('src',jQuery(this).attr('src'));
        });
      }
    }else{
      var foto0 = jQuery('[data-item="'+item+'"]').children('.listing__foto').attr('data-src');
    }
    jQuery('.listing__popup-foto img:first').addClass('animation-opacity-0').attr('src', foto0).on("load", function() {
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
    jQuery(".portfolio__img").remove();
    jQuery('.listing__popup-foto img:first').attr('style', '');
    if(item == calc) {
      item = 1;
    } else {
      item++;
    }
    var stuff = jQuery('[data-item="'+item+'"]').children('.listing__foto').attr('data-src').split(',');
    jQuery('.listing__popup-title').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').children('.listing__title').html());;
    jQuery('.listing__popup-description').addClass('animation-opacity-0').html(jQuery('[data-item="'+item+'"]').attr('data-description'));
    jQuery('.listing__arrow-left').addClass('animation-opacity-0');
    jQuery('.listing__arrow-right').addClass('animation-opacity-0');
    if(portfolio){
      var foto0 = stuff[0];
      if(stuff.length > 1){
        jQuery('.listing__popup-foto img:first').css('max-height','calc(100vh - 200px)');
        jQuery.each(stuff,function(index,value){
          jQuery('.listing__popup-foto').append('<img class="portfolio__img" src="'+value+'" style="height:80px;margin: 5px;cursor:pointer;">');
        });
        jQuery(".portfolio__img").on('click', function(){
          jQuery('.listing__popup-foto img:first').attr('src',jQuery(this).attr('src'));
        });
      }
    }else{
      var foto0 = jQuery('[data-item="'+item+'"]').children('.listing__foto').attr('data-src');
    }
    jQuery('.listing__popup-foto img:first').addClass('animation-opacity-0').attr('src', foto0).on("load", function() {
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
    jQuery(".portfolio__img").remove();
    jQuery('.listing__popup-foto img:first').attr('style', '');
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