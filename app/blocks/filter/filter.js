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