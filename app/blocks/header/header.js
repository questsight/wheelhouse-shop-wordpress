jQuery( document ).ready( function() {
  jQuery('#icon-search').on('click', function(){
    jQuery('#icon-search').toggleClass('active');
    jQuery('#form-search').toggleClass('active');
  });
});