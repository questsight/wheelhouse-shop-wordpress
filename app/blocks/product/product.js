jQuery( document ).ready( function() {
  var scheme = false;
  jQuery(".product__img").on('click', function(){
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
});