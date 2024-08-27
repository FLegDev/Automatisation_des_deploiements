	  jQuery(document).ready(function($){
    $(".desinscriptionBtn").click(function(){ 
     $("#desinscriptionForm").css('display','block');
     $("#persoForm").css('display','none');
    });
  });

  jQuery(document).ready(function($){
    $(".persoBtn").click(function(){ 
     $("#persoForm").css('display', 'block');
     $("#desinscriptionForm").css('display','none');
    });
  });

(function($) {

    function dc_collapse_submenus() {
        var $menu = $('#mobile_menu'),
            dc_top_level_link = '#mobile_menu .menu-item-has-children > a';

        $menu.find('a').each(function() {
            $(this).off('click');

            if ($(this).is(dc_top_level_link)) {
                $(this).attr('href', '#');
            }

            if (!$(this).siblings('.sub-menu').length) {
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

});

jQuery(function($) {
    $('.et_pb_toggle_title').click(function() {
        var $toggle = $(this).closest('.et_pb_toggle');
        if (!$toggle.hasClass('et_pb_accordion_toggling')) {
            var $accordion = $toggle.closest('.et_pb_accordion');
            if ($toggle.hasClass('et_pb_toggle_open')) {
                $accordion.addClass('et_pb_accordion_toggling');
                $toggle.find('.et_pb_toggle_content').slideToggle(700, function() {
                    $toggle.removeClass('et_pb_toggle_open').addClass('et_pb_toggle_close');

                });
            }
            setTimeout(function() {
                $accordion.removeClass('et_pb_accordion_toggling');
            }, 750);
        }
    });
});

/* Preloader

document.onreadystatechange = function () {
    if (document.readyState !== "complete") {
        document.querySelector("body").style.visibility = "hidden";
        document.querySelector("#loadContainer").style.visibility = "visible";
    } else {
        document.querySelector("#loadContainer").style.display = "none";
        document.querySelector("body").style.visibility = "visible";
    }
};
*/


