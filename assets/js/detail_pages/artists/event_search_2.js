
    $(document).ready(function(){
        $('.navbar-toggle').click(function () {
            $('.navbar-nav').toggleClass('slide-in');
            $('.side-body').toggleClass('body-slide-in');
            //$('#search').removeClass('in').addClass('collapse').slideUp(200);
        
            /// uncomment code for absolute positioning tweek see top comment in css
            //$('.absolute-wrapper').toggleClass('slide-in');
            
        });
        $(".horizontal-images .wp_fan_slide").hover(function(){
            $(this).find(".content_pan_cp").slideUp();
            //$(this).find(".content_pan_cp_hover").fadeIn();
            $(this).find(".content_pan_cp_hover").slideDown();
        },function(){
            $(this).find(".content_pan_cp_hover").slideUp();
            //$(this).find(".content_pan_cp_hover").fadeIn();
            $(this).find(".content_pan_cp").slideDown();
        })
    })	
    