/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
}

$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    console.log($(this));
    $(".navbar-collapse ul li").each(function(){
       if($(this).hasClass('active'))
        {
            $(this).removeClass('active');
        }
    })
    $(this).parent().addClass('active');
    // $(this).closest('.collapse').collapse('toggle');
});


    /* ========================================================================= */
    /*  Skills Chart
    /* ========================================================================= */

    $(".chart").appear(function () {
        $(".chart").easyPieChart({
            easing: "easeOutBounce",
            barColor: "#6CB670",
            size: "150",
            lineWidth: 15,
            animate: 2e3,
            onStep: function (e, t, n) {
                $(this.el).find(".percent").text(Math.round(n))
            }
        })
    });