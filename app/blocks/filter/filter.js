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