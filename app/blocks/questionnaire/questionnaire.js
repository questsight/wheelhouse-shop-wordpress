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