jQuery(document).ready(function () {
  jQuery('.product__cloth').on('click', function(){
    jQuery('.cloth').removeClass('hidden');
  });
  jQuery('.cloth__color').on('click', function(){
    jQuery('[data-marker]').attr('value',jQuery(this).attr('data-color'));
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div style="text-align:center; padding:30px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
    jQuery.ajax({
        url: 'https://wheelhousedesign.ru/wp-content/themes/questsight/ajax-cloth.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#cloth__color').addClass('hidden');
    jQuery('#result-cloth').removeClass('hidden');
  });
  jQuery('.cloth__close').on('click', function(){
    price = "";
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('#cloth__color').removeClass('hidden');
    jQuery('.cloth').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.cloth__close').click();
    }
  });
  jQuery('.product__cloth-add').on('click', function(){
    jQuery('#cloth__color').addClass('hidden');
    jQuery('.cloth').removeClass('hidden');
    jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div style="text-align:center; padding:30px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
    jQuery.ajax({
        url: 'https://wheelhousedesign.ru/wp-content/themes/questsight/ajax-cloth-add.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#result-cloth').removeClass('hidden');
  });
})
jQuery(document).ready(function () {
  jQuery('.filter__title').on('click', function(){
    if ( window.matchMedia( '(max-width: 991px)' ).matches ) {
      var type = jQuery(this).attr('data-type');
      jQuery('.filter__item').addClass('hidden_type_min-md');
      if(!jQuery(this).hasClass('open')){
        jQuery('.filter__item[data-type='+type+']').removeClass('hidden_type_min-md');
        jQuery('.filter__title').removeClass('open');
        jQuery(this).addClass('open');
      } else {
        jQuery('.filter__title').removeClass('open');
      }
    }
  });
  jQuery('.filter__close').on('click', function(){
    jQuery('.filter').addClass('hidden_type_min-md');
    jQuery('.filter__call').removeClass('hidden_type_min-md');
  });
  jQuery('.filter__show').on('click', function(){
    jQuery('.filter').addClass('hidden_type_min-md');
    jQuery('.filter__call').removeClass('hidden_type_min-md');
  });
  jQuery('.filter__call').on('click', function(){
    jQuery('.filter').removeClass('hidden_type_min-md');
    jQuery('.filter__call').addClass('hidden_type_min-md');
  });

  jQuery("#filter-materialy input").change(function(e) {
    var str = jQuery("#filter-materialy").serialize();
    history.pushState({}, '', '?'+str);
    jQuery("#result-materialy").html('<div style="text-align:center; padding:30px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
    jQuery.ajax({
        url: 'https://wheelhousedesign.ru/wp-content/themes/questsight/ajax-materialy.php',
        data: str,
        method: 'GET',
        success: function(data){
          jQuery("#result-materialy").html(data);
        }
    });
  });
  jQuery("#filter-product input").change(function(e) {
    if(jQuery(this).attr('value')=='all'){
      var allname = jQuery(this).attr('data-call');
      if(jQuery(this).attr('data-active')){
        jQuery(this).removeAttr('data-active');
        jQuery('['+allname+']').removeAttr('checked');
      } else {
        jQuery(this).attr('data-active',"active");
        jQuery('['+allname+']').attr('checked','checked');
      }
    }
      var str = jQuery("#filter-product").serialize();
      history.pushState({}, '', '?'+str);
      jQuery("#result-product").html('<div style="text-align:center; padding:30px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
      jQuery.ajax({
        url: 'https://wheelhousedesign.ru/wp-content/themes/questsight/ajax-product.php',
        data: str,
        method: 'GET',
        success: function(data){
          jQuery("#result-product").html(data);
        }
    });
  });
})
jQuery( document ).ready( function() {
  jQuery('.agree').prop('checked', false);
});
jQuery( document ).ready( function() {
	jQuery( '#hamburger' ).click( function () {
		jQuery( '.hamburger__item' ).toggleClass( 'hamburger__item_open' );
    jQuery( '#navigation' ).toggleClass('hidden_type_min-md');
	}); 
});
jQuery( document ).ready( function() {
  jQuery('#icon-search').on('click', function(){
    jQuery('#icon-search').toggleClass('active');
    jQuery('#form-search').toggleClass('active');
  });
});
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
//let vh = window.innerHeight * 0.01;
//document.documentElement.style.setProperty('--vh', vh + 'px');
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
      });
    }
  });
  jQuery('#navigation .navigation__list .menu-item-has-children > a', this).on('click', function(){
    if ( window.matchMedia( '(min-width: 992px)' ).matches ) {
      return false;
    }
  });
});
jQuery( document ).ready( function() {
  jQuery( '.popup__exit' ).click( function() {
    jQuery('.popup').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery( '.popup' ).addClass('hidden'); 
    }
  });
  jQuery( '.popup' ).click( function (e) {
    var content = jQuery("> .popup__content",this);
    if (!content.is(e.target) && content.has(e.target).length === 0) {
			jQuery( '.popup' ).addClass('hidden');
		}
	});
  jQuery( '[data-popup]' ).click( function() {
    jQuery('#' + jQuery(this).attr("data-popup")).removeClass('hidden');
  });
});
jQuery( document ).ready( function() {
  jQuery('.product_first').attr('srcset',jQuery('.product__img').attr('data-src'));
  jQuery('.product_first').attr('src',jQuery('.product__img').attr('data-src'));
  jQuery(".product__img").on('click', function(){
    jQuery('.product_first').attr('srcset',jQuery(this).attr('data-src'));
    jQuery('.product_first').attr('src',jQuery(this).attr('data-src'));
  });
var native_width = 0;
  var native_height = 0;
  var mouse = {x: 0, y: 0};
  var magnify;
  var cur_img;

  var ui = {
    magniflier: jQuery('.magniflier')
  };
  if (ui.magniflier.length) {
    var div = document.createElement('div');
    div.setAttribute('class', 'glass');
    ui.glass = jQuery(div);

    jQuery('body').append(div);
  }
  var mouseMove = function(e) {
    var magnify_offset = cur_img.offset();
    mouse.x = e.pageX - magnify_offset.left;
    mouse.y = e.pageY - magnify_offset.top;
    if (
      mouse.x < cur_img.width() &&
      mouse.y < cur_img.height() &&
      mouse.x > 0 &&
      mouse.y > 0
      ) {
      magnify(e);
    }
    else {
      ui.glass.fadeOut(100);
    }
    return;
  };
  var magnify = function(e) {
    var rx = Math.round(mouse.x/cur_img.width()*native_width - ui.glass.width()/2)*-1;
    var ry = Math.round(mouse.y/cur_img.height()*native_height - ui.glass.height()/2)*-1;
    var bg_pos = rx + "px " + ry + "px";
    var glass_left = e.pageX - ui.glass.width() / 2;
    var glass_top  = e.pageY - ui.glass.height() / 2;
    ui.glass.css({
      left: glass_left,
      top: glass_top,
      backgroundPosition: bg_pos
    });
    return;
  };
  jQuery(ui.magniflier).on('mousemove', function() {
	ui.glass.fadeIn(100);
    cur_img = jQuery(this);
    var src = cur_img.attr('src');
    if (src) {
      ui.glass.css({
        'background-image': 'url(' + src + ')',
        'background-repeat': 'no-repeat'
      });
    }
      if (!cur_img.data('native_width')) {
        var image_object = new Image();
        image_object.onload = function() {
          native_width = image_object.width;
          native_height = image_object.height;
          cur_img.data('native_width', native_width);
          cur_img.data('native_height', native_height); 
		  mouseMove.apply(this, arguments);
          ui.glass.on('mousemove', mouseMove);
        };
        image_object.src = src;
      return;
      } else {
        native_width = cur_img.data('native_width');
        native_height = cur_img.data('native_height');
      }
    mouseMove.apply(this, arguments);
    ui.glass.on('mousemove', mouseMove);
  });
  jQuery('.product__variation-choice').on('click', function(){
    jQuery('>.product__variation-select',this).removeClass('hidden');
  });
  jQuery( ".product__variation-input input" ).change(function() {
    var ids = jQuery(this).attr("data-ids");
    if (jQuery(this).is(':checked')){
      jQuery('#'+ids+' option[value="true"]').prop('selected',true);
      jQuery('#'+ids).change();
    } else {
      jQuery('#'+ids+' option[value="false"]').prop('selected',true);
      jQuery('#'+ids).change();
    }
  });
  jQuery( ".product__variation-choice" ).change(function(e) {
    if(jQuery( this ).attr("id")){
      var a = jQuery( this ).attr("id");
      if(a.indexOf('size') > -1) {
        jQuery('[data-scheme]').addClass('hidden');
        if(jQuery(this).val()){
          jQuery('[data-scheme='+jQuery(this).val()+']').removeClass('hidden');
        }
      } 
    } 
  });
});
jQuery( document ).ready( function() {
  var calc = 9;
  var item = 1;
  var error = 0;
  var divan = 0;
  jQuery("[data-questionnaire]").on('click', function(){
    jQuery('.questionnaire').removeClass("hidden");
  });
  jQuery('[value="диван"]').change( function(e){
    if(jQuery('[value="диван"]').is(':checked')){
      divan = 1;
    }else{
      divan = 0;
    }
  });
  jQuery('.required').change( function(){
    if(error == 1){
      jQuery('.questionnaire__error').addClass('hidden');
    }
  });
  jQuery(".farther").on('click', function(){
    if(item == 1) {
      error = 0;
      if(jQuery('.required').val() == ''){
        error = 1;
        jQuery('.questionnaire__error').removeClass('hidden');
      }
    }
    if(error != 1){
      jQuery('[data-item="'+ item +'"]').addClass("hidden");
      if(item == 4 && divan == 0){
        item++;
      }
      item++;
    }
    if(item == calc) {
      jQuery('.farther').addClass("hidden");
      jQuery('.back').addClass("hidden");
    }
    if(item == 2) {
      jQuery('.back').removeClass("hidden"); 
    }
    jQuery('[data-item="'+ item +'"]').removeClass("hidden");
  });
  jQuery(".back").on('click', function(){
    jQuery('[data-item="'+ item +'"]').addClass("hidden");
    if(item == 6 && divan == 0){
        item--;
    }
    item--;
    if(item == 1) {
      jQuery('.back').addClass("hidden");
    }
    jQuery('[data-item="'+ item +'"]').removeClass("hidden");
  });
  jQuery( '.questionnaire__close' ).click( function() {
    jQuery( '.questionnaire__partition' ).addClass('hidden');
    jQuery('.questionnaire__partition[data-item="1"]').removeClass('hidden');
    jQuery('.questionnaire').addClass('hidden');
    jQuery('.back').addClass('hidden');
    jQuery('.farther').removeClass('hidden');
    item = 1;
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.questionnaire__close').click();
    }
  });
});