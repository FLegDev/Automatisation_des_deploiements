/*----let x='ca Marche';
console.log(x);
-----*/
(function($) {
      
    function dc_collapse_submenus() {
        var $menu = $('#mobile_menu'),
            dc_top_level_link = '#mobile_menu .menu-item-has-children > a';
             
        $menu.find('a').each(function() {
            $(this).off('click');
              
            if ( $(this).is(dc_top_level_link) ) {
                $(this).attr('href', '#');
            }
              
            if ( ! $(this).siblings('.sub-menu').length ) {
                $(this).on('click', function(event) {
                    $(this).parents('.mobile_nav').trigger('click');
                });
            } else {
                $(this).on('click', function(event) {
                    event.preventDefault();
                    $(this).parent().toggleClass('visible');
                });
            }
        });
    }
      
    $(window).load(function() {
        setTimeout(function() {
            dc_collapse_submenus();
        }, 700);
    });
 
})(jQuery);

 /*------- SAV  ----- 
--- Masquage des formulaires au chargement de la page ----*/ 

jQuery(document).ready(function($){
  $(".imgform1").click(function(){
    $("#formsav1").css('display','block');
    $("#formsav2").css('display','none');
    $("#formsav3").css('display','none');
  });
});  
jQuery(document).ready(function($){
  $(".imgform2").click(function(){
    $("#formsav2").css('display','block');
    $("#formsav1").css('display','none');
    $("#formsav3").css('display','none');
  });
});  
jQuery(document).ready(function($){
  $(".imgform3").click(function(){
    $("#formsav3").css('display','block');
    $("#formsav2").css('display','none');
    $("#formsav1").css('display','none');
  });
});
jQuery(document).ready(function($){
  $("#gallerie_01").hover(function(){
    $("#icone01").toggle();
    
  });
});