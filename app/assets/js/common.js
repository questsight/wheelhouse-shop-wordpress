jQuery(document).ready(function () {
  jQuery('#product__colors').on('click', function(){
    jQuery('.colors').removeClass('hidden');
    var str = jQuery("#product-colors").serialize();
    jQuery("#result-colors").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-colors.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-colors").html(data);
        }
    });
    jQuery('#result-colors').removeClass('hidden');
  });
  jQuery('.colors__close').on('click', function(){
    jQuery('.colors').addClass('hidden');
    jQuery('#result-colors').addClass('hidden');
  });
})
jQuery(document).ready(function () {
  jQuery('.product__cloth').on('click touchend', function(){
    jQuery('.cloth').removeClass('hidden');
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-cloth.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#result-cloth').removeClass('hidden');
  });
  jQuery('.cloth__close').on('click touchend', function(){
    price = "";
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-cloth').addClass('hidden');
    jQuery('.cloth').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.cloth__close').click();
    }
  });
  jQuery('.product__cloth-add').on('click touchend', function(){
    jQuery('.cloth').removeClass('hidden');
    jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#filter-cloth").serialize();
    jQuery("#result-cloth").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-cloth-add.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-cloth").html(data);
        }
    });
    jQuery('#result-cloth').removeClass('hidden');
  });
  jQuery('.product__cloth-fix').on('click touchend', function(){
    jQuery('#popup-fix img').attr('src',jQuery(this).attr('data-fix'));
    jQuery('#popup-fix').removeClass('hidden');
  });
  jQuery('#popup-fix .popup__content .listing__close').on('click touchend', function(){
    jQuery('#popup-fix').addClass('hidden');
    jQuery('#popup-fix img').attr('src','');
  })
})
jQuery(document).ready(function () {
  jQuery('.filter__title').on('click', function(){
      var type = jQuery(this).attr('data-type');
      if(!jQuery(this).hasClass('open')){
        jQuery('.filter__item[data-type='+type+']').removeClass('hidden');
        jQuery(this).addClass('open');
      } else {
        jQuery(this).removeClass('open');
        jQuery('.filter__item[data-type='+type+']').addClass('hidden');
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
    jQuery("#result-materialy").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin + '/wp-content/themes/questsight/ajax-materialy.php',
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
      jQuery("#result-product").html('<div class="spinner"></div>');
      jQuery.ajax({
        url: window.location.origin + '/wp-content/themes/questsight/ajax-product.php',
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
//let vh = window.innerHeight * 0.01;
//document.documentElement.style.setProperty('--vh', vh + 'px');
jQuery(document).ready(function () {
  jQuery('#pa_size-krd').change(function() {
    jQuery('[name="mattress-size"]').attr('value',jQuery(this).val());
    if(jQuery('#product__mattress').attr('data-fix')){
      jQuery('#product__mattress').html('Выбрать матрас');
    }else{
      jQuery('#product__mattress').html('Добавить матрас');
    }
    jQuery('#product__namatrasniki').html('Добавить наматрасник');
    jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    jQuery('#product__pokryvala').html('Добавить покрывало');
    jQuery('#product__mattress').parent('.product__variation').removeClass('choice');
    jQuery('#product__mattress').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__namatrasniki').parent('.product__variation').removeClass('choice');
    jQuery('#product__namatrasniki').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__chehly-na-matras').parent('.product__variation').removeClass('choice');
    jQuery('#product__chehly-na-matras').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__pokryvala').parent('.product__variation').removeClass('choice');
    jQuery('#product__pokryvala').parent('.product__variation').children('.product__delete').addClass('hidden');
    //jQuery('#product__podushki').html('Добавить подушки');
    jQuery('#add-mattress').removeAttr('name');
    jQuery('#add-namatrasniki').removeAttr('name');
    jQuery('#add-chehly-na-matras').removeAttr('name');
    jQuery('#add-pokryvala').removeAttr('name');
    //jQuery('#add-podushki').removeAttr('name');
    jQuery('#add-mattress').removeAttr('value');
    jQuery('#add-namatrasniki').removeAttr('value');
    jQuery('#add-chehly-na-matras').removeAttr('value');
    jQuery('#add-pokryvala').removeAttr('value');
    //jQuery('#add-podushki').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-mattress');
    jQuery('.variation_id').removeAttr('data-namatrasniki');
    jQuery('.variation_id').removeAttr('data-chehly-na-matras');
    jQuery('.variation_id').removeAttr('data-pokryvala');
    //jQuery('.variation_id').removeAttr('data-podushki');
  });
  jQuery('#pa_kategoriya-tkani').change(function() {
    jQuery('[name="mattress-size"]').attr('value',jQuery(this).val());
    jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    jQuery('#product__pokryvala').html('Добавить покрывало');
    jQuery('#product__podushki').html('Добавить подушки');
    jQuery('#product__chehly-na-matras').parent('.product__variation').removeClass('choice');
    jQuery('#product__chehly-na-matras').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__pokryvala').parent('.product__variation').removeClass('choice');
    jQuery('#product__pokryvala').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__chehly-na-matras').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#product__podushki').parent('.product__variation').removeClass('choice');
    jQuery('#product__podushki').parent('.product__variation').children('.product__delete').addClass('hidden');
    jQuery('#add-chehly-na-matras').removeAttr('name');
    jQuery('#add-pokryvala').removeAttr('name');
    jQuery('#add-podushki').removeAttr('name');
    jQuery('#add-chehly-na-matras').removeAttr('value');
    jQuery('#add-pokryvala').removeAttr('value');
    jQuery('#add-podushki').removeAttr('value');
    jQuery('.variation_id').removeAttr('data-chehly-na-matras');
    jQuery('.variation_id').removeAttr('data-pokryvala');
    jQuery('.variation_id').removeAttr('data-podushki');
  });
  jQuery('.variation_id').change( function(){
    jQuery('[name="mattress-size"]').attr('value',jQuery('#pa_size-krd').val());
  });
  jQuery('#product__mattress').on('click touchend', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-mattress.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__namatrasniki').on('click touchend', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-namatrasniki.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__chehly-na-matras').on('click touchend', function(){
    jQuery('.mattress').removeClass('hidden');
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-chehly-na-matras.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__pokryvala').on('click touchend', function(){
    jQuery('.mattress').removeClass('hidden');
    //jQuery('[name="item"]').attr('value',jQuery(this).attr('data-item'));
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-pokryvala.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('#product__podushki').on('click touchend', function(){
    jQuery('.mattress').removeClass('hidden');
    var str = jQuery("#mattress-size").serialize();
    jQuery("#result-mattress").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-podushki.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-mattress").html(data);
        }
    });
    jQuery('#result-mattress').removeClass('hidden');
  });
  jQuery('.mattress__close').on('click touchend', function(){
    jQuery('.cloth__popup').addClass('hidden');
    jQuery('#result-mattress').addClass('hidden');
    jQuery('.mattress').addClass('hidden');
  });
  jQuery('.product__delete').on('click touchend', function(){
    var cat = jQuery(this).attr("id").replace('del-', '');
    /*if(cat=='mattress'){
      if(jQuery('#product__mattress').attr('data-fix')){
        jQuery('#product__mattress').html('Выбрать матрас');
      }else{
        jQuery('#product__mattress').html('Добавить матрас');
      }
    }else if (cat=='namatrasniki') {
      jQuery('#product__namatrasniki').html('Добавить наматрасник');
    }else if (cat=='chehly-na-matras') {
      jQuery('#product__chehly-na-matras').html('Добавить чехол на матрас');
    }else if (cat=='pokryvala') {
      jQuery('#product__pokryvala').html('Добавить покрывало');
    }else if (cat=='podushki') {
      jQuery('#product__podushki').html('Добавить подушки');
    }*/
    if(cat=='podushki'){
      jQuery('[data-deposit="podushki"]').remove();
      jQuery('[data-type="add-podushki"]').remove();
    }else{
      jQuery('#add-'+cat).removeAttr('name');
      jQuery('#add-'+cat).removeAttr('value');
      jQuery('#add-'+cat+'-deposit').removeAttr('name');
    }
    var oldPrice = parseInt(jQuery('.variation_id').attr('data-'+cat), 10);
    var dp = + jQuery('.summary .price .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - oldPrice;
    var rp = + jQuery('.summary .price del .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - oldPrice;
    var sp = + jQuery('.summary .price ins .woocommerce-Price-amount bdi').text().replace(/\₽.*/, '').replace(/\s+/g, '') - oldPrice;
    jQuery('.variation_id').removeAttr('data-'+cat);
    jQuery('.summary .price .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+dp) + " ₽");
    jQuery('.summary .price del .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+rp) + " ₽");
    jQuery('.summary .price ins .woocommerce-Price-amount bdi').html(new Intl.NumberFormat('ru-RU').format(+sp) + " ₽");
    jQuery('#product__'+cat).parent('.product__variation').removeClass('choice');
    jQuery('#additional-'+cat+' .product__add-item').html('');
    jQuery('#additional-'+cat).addClass('hidden');
    jQuery('#product-'+cat).removeClass('active');  //jQuery('#product__'+cat).parent('.product__variation').children('.product__delete').addClass('hidden');
  });
})
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
      jQuery('.product__variation').addClass('product__variation-block');
    }
  },function(){
    jQuery('.product__variation').removeClass('product__variation-block');
  });;
  jQuery('#navigation .navigation__list .menu-item-has-children > a', this).on('click', function(){
    if ( window.matchMedia( '(min-width: 992px)' ).matches ) {
      return false;
    }
  });
});
jQuery(document).ready(function () {
  jQuery('.product__pillar').on('click touchend', function(){
    jQuery('.pillar').removeClass('hidden');
    var str = jQuery("#product-pillar").serialize();
    jQuery("#result-pillar").html('<div class="spinner"></div>');
    jQuery.ajax({
        url: window.location.origin+'/wp-content/themes/questsight/ajax-pillar.php',
        data: str,
        method: 'POST',
        success: function(data){
          jQuery("#result-pillar").html(data);
        }
    });
    jQuery('#result-pillar').removeClass('hidden');
  });
  jQuery('.pillar__close').on('click', function(){
    jQuery('#result-pillar').addClass('hidden');
    jQuery('.pillar').addClass('hidden');
  });
  jQuery(this).keydown(function(eventObject){
    if (eventObject.which == 27){
      jQuery('.pillar__close').click();
    }
  });
})
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
  var scheme = false;
  jQuery(".product__img").on('click touchend', function(){
    jQuery('.product__first img').attr('src',jQuery(this).attr('data-src'));
    if(jQuery(this).attr('data-scheme')){
      scheme = true;
    }
  });
  var choiseOne = false;
  jQuery( ".product__variation-choice" ).change(function(e) {
    if(jQuery( this ).attr("id") && choiseOne){
      var a = jQuery( this ).attr("id");
      if(a.indexOf('size') > -1) {
        jQuery('[data-scheme]').addClass('hidden');
        if(jQuery(this).val() && jQuery('img').is('[data-scheme='+jQuery(this).val()+']')){
          jQuery('[data-scheme='+jQuery(this).val()+']').removeClass('hidden');
          jQuery('[data-scheme='+jQuery(this).val()+']').click();
        }else if(scheme){
          jQuery('.product__first img').attr('src',jQuery(".product__img").attr('data-src'));
          scheme = false;
        }
      } 
    }
    choiseOne = true;
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
    if(window.matchMedia( '(min-width: 992px)' ).matches){
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
  }});
  jQuery('.product__variation-choice span').on('click touchend', function(){
    jQuery('>.product__variation-select',jQuery(this).parent('.product__variation-choice')).toggleClass('hidden');
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
jQuery('.wc-pao-addon-name').each(function() {
  jQuery(this).attr("data-position",jQuery(this).position().top);
})
jQuery('.ajax_add_to_cart').on('click', function(){
  var validation = true;
  jQuery('select.product__variation-choice').each(function() {
    if(!jQuery(this).val()){
      jQuery(this).parent().parent().children('.wc-pao-addon-name').addClass("accent");
      validation = false;
      jQuery(this).change(function() {
        jQuery(this).parent().parent().children('.wc-pao-addon-name').removeClass("accent");
      });
    }
  });
  jQuery('[name="_material[]"]').each(function() {
    if(!jQuery(this).val()){
      jQuery('#_material-title').addClass("accent");
      /*if(jQuery(".choice__basic").hasClass('hidden')&&jQuery(".choice__color").hasClass('hidden')){
        jQuery('#product__colors').addClass("accent").on('click', function(){
          jQuery(this).removeClass("accent");
        });
      }else if(!jQuery(".choice__basic").hasClass('hidden')){
        if(jQuery(this).attr('data-key')=="pillar"){
          jQuery('.choice__pillar').children('.product__pillar').addClass("accent").on('click', function(){
          jQuery(this).removeClass("accent");
        });
        }else if(jQuery(this).attr('data-key')=="0"){
          jQuery('.choice__basic').eq(jQuery(this).attr('data-key')).children('.product__cloth').addClass("accent").on('click', function(){
          jQuery(this).removeClass("accent");
        });
        }else{
          jQuery('.choice__basic').eq(jQuery(this).attr('data-key')).children('.product__cloth-add').addClass("accent").on('click', function(){
          jQuery(this).removeClass("accent");
        });
        }
      }else{
        jQuery('.choice__pillar').children('.product__pillar').addClass("accent").on('click', function(){
          jQuery(this).removeClass("accent");
        });
      }*/
      validation = false;
    }
  });
  if(!validation){
    if ( window.matchMedia( '(min-width: 768px)' ).matches ) {
      jQuery('html,body').animate({
        scrollTop: jQuery(".product__form-scroll").offset().top - 20,
      }, 0);
      jQuery('.product__form-scroll').animate({
        scrollTop: jQuery(".accent").attr('data-position') - 30,
      }, 0);
    }else{
      jQuery('html,body').animate({
        scrollTop: jQuery(".accent").position().top - 20,
      }, 0); 
    }
    jQuery('[name="_material[]"]').each(function() {
      if(!jQuery(this).val()){
        acc = 0;
      }
    })
    return false;
  }
});
jQuery('.product__sidebar-option').on('click touchend', function(){
  jQuery('.product__sidebar-option').removeClass('active');
  jQuery(this).addClass('active');
  jQuery('.product__sidebar').addClass('hidden');
  jQuery('.product__sidebar[data-type="'+jQuery(this).attr('data-call')+'"]').removeClass("hidden");
});
jQuery('.product__variation-text').on('click', function(){
  if(jQuery(this).attr('data-select')){
    jQuery('#'+jQuery(this).attr('data-select')).children('[value='+jQuery(this).attr('data-option')+']').prop('selected',true).change();
    
    jQuery('[data-select="'+jQuery(this).attr("data-select")+'"]').parent().removeClass('active');
    jQuery(this).parent().addClass('active');
  }
});
jQuery('.wc-pao-addon-osnovanie-spalnogo-mesta p .wc-pao-addon-image-swatch').on("click touchend", function(){
  jQuery('[data-slug="wc-pao-addon-osnovanie-spalnogo-mesta"]').html('- '+jQuery(this).attr('data-item'));
});
jQuery('.wc-pao-addon-vybrat-formu-opor p .wc-pao-addon-image-swatch').on("click touchend", function(){
  jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch').addClass('hidden');
  if(jQuery(this).attr('data-item')!='Скользящий подпятник'){
    jQuery('.wc-pao-addon-vybrat-czvet-opor').removeClass('hidden');
  }else{
    jQuery('.wc-pao-addon-vybrat-czvet-opor').addClass('hidden');
    jQuery('.wc-pao-addon-vybrat-czvet-opor select option').prop('selected', false);
    jQuery('.wc-pao-addon-vybrat-czvet-opor select option:last').prop('selected', true);
  }
  if(jQuery(this).attr('data-item')=='Пирамида 45 мм'||jQuery(this).attr('data-item')=='Пирамида 100 мм'||jQuery(this).attr('data-item')=='Пирамида 120 мм'||jQuery(this).attr('data-item')=='Сфера 45 мм'||jQuery(this).attr('data-item')=='Фигурная 100 мм'){
    jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch[data-item="Цвет белый"]').removeClass('hidden');
    jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch[data-item="Цвет серый"]').removeClass('hidden');
    jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch[data-item="Цвет натуральный бук"]').removeClass('hidden');
    jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch[data-item="Цвет орех"]').removeClass('hidden');
    jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch[data-item="Цвет венге"]').removeClass('hidden');
    jQuery('.wc-pao-addon-vybrat-czvet-opor p .wc-pao-addon-image-swatch[data-item="Цвет черный"]').removeClass('hidden');
  }
});
if(jQuery('iframe#v3d_iframe')){
    var hC = jQuery('iframe#v3d_iframe').width() / 3 * 2;
    jQuery('iframe#v3d_iframe').height(hC);
  } 
});
jQuery( window).resize(function() {
  if(jQuery('iframe#v3d_iframe')){
    var hC = jQuery('iframe#v3d_iframe').width() / 3 * 2;
    jQuery('iframe#v3d_iframe').height(hC);
  } 
})

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
    if(item == 8){
      jQuery('.farther').removeClass("hidden");
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