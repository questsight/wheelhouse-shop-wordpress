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
