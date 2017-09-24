
/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("//assets.zendesk.com/embeddable_framework/main.js","99soundhelp.zendesk.com");
/*]]>*/


$(document).ready(function() {
    $(".sponsors a img").hover(function(){
        $(this).animate({
            top: '-30px'
        }, 500);
    }, function(){
        $(this).animate({
            top: '0px'
        }, 500);
    });
    
    $('[data-toggle="tooltip"]').tooltip(); 
    $('.click-ft').click(function(event){
        event.preventDefault();
        $('.click-ft .chevron_up').toggleClass("hiden");
        $('.click-ft .chevron_down').toggleClass("show");
        $('.footer').toggleClass('active');
        $("body").animate({ scrollTop: 999999 }, 'slow');
    });
    $("body").niceScroll({
			cursorcolor: "#2f2e2e",
			cursoropacitymax: 0.6,
			boxzoom: false,
			touchbehavior: false,
            cursorwidth:13, 
		});
		
		$("body").scroll(function()
		{
		  $(this).getNiceScroll().resize();
		});
    var isTouch = !!('ontouchstart' in window),
            clickEvent = isTouch ? 'tap' : 'click';

        (function() {
            // Global slider's DOM elements
            var $example = $('#example'),
                $parent = $('.mightyslider_modern_skin', $example),
                $tabs = $('.tabs ul', $example),
                $frame = $('.frame', $example);

            // Calling mightySlider via jQuery proxy
            $frame.mightySlider({
                    speed: 1000,
                    autoScale: 'easeOutExpo',
                    easing: 'easeOutExpo',

                    // Navigation options
                    navigation: {
                        slideSize: '100%'
                    },

                    // Thumbnails options
                    thumbnails: {
                        horizontal: 0,
                        preloadThumbnails: 0,
                        activateOn: clickEvent,
                        thumbnailsBar: $tabs,
                        thumbnailBuilder: function(index, thumbnail) {
                            return '<li><h3>' + this.slides[index].options.title + '</h3>by ' + this.slides[index].options.owner + '</li>';
                        }
                    },

                    // Commands options
                    commands: {
                        buttons: 1
                    }
                },

                // Register callbacks to the events
                {
                    // Register mightySlider :active event callback
                    active: function(name, index) {
                        var skin = this.slides[index].options.skin || '';
                        $example.removeClass('black').addClass(skin);
                    }
                });
                $('.mSSlideElement .active .mSCover').addClass("hidden-cover");
        })(); 
     $('.video-background').parallax("50%", 0);
    $('.artist-signup').parallax("50%", 0);
    $('.artist-home').parallax("050%", 0);
    $('.artist-industry').parallax("50%", 0);
    $('.main-img').parallax("50%", 0.1);
    
});
$(function() {

        // IE detect
        function iedetect(v) {
            
             if (!!window.FileReader)
             {}
             else
             {
                return true;
             }
            var r = RegExp('msie' + (!isNaN(v) ? ('\\s' + v) : ''), 'i');
            return r.test(navigator.userAgent);

        }
        
        // For mobile screens, just show an image called 'poster.jpg'. Mobile
        // screens don't support autoplaying videos, or for IE.
        if (screen.width < 800 || iedetect(8) || iedetect(7) || 'ontouchstart' in window) {
        //if (screen.width < 800 || iedetect(8) || iedetect(7)) {
            (adjSize = function() { // Create function called adjSize

                $width = $(window).width(); // Width of the screen
                $height = $(window).height(); // Height of the screen

                // Resize image accordingly
                $('#container_new').css({
                    'background-image': 'url(<?php echo base_url() ?>/assets/background-videos/poster.jpg)',
                    'background-size': 'cover',
                    'width': $width + 'px',
                    'height': $height + 'px',
                    'display': 'block'
                }); 
                $('main').hide();
                $('#container1').css({
                    'background-image': 'url(/assets/background-videos/poster.jpg)',
                    'background-size': 'cover',
                    'width': $width + 'px',
                    'height': $height + 'px'
                });

                // Hide video
                $('video').hide();
                $('video1').hide();

            })(); // Run instantly

            // Run on resize too
            $(window).resize(adjSize);
        } else {
            // Wait until the video meta data has loaded
            $('#container video').on('loadedmetadata', function() {

                var $width, $height, // Width and height of screen
                    $vidwidth = this.videoWidth, // Width of video (actual width)
                    $vidheight = this.videoHeight, // Height of video (actual height)
                    $aspectRatio = $vidwidth / $vidheight; // The ratio the video's height and width are in

                (adjSize = function() { // Create function called adjSize

                    $width = $(window).width(); // Width of the screen
                    $height = $(window).height(); // Height of the screen

                    $boxRatio = $width / $height; // The ratio the screen is in

                    $adjRatio = $aspectRatio / $boxRatio; // The ratio of the video divided by the screen size

                    // Set the container to be the width and height of the screen
                    $('#container').hide();
                    $('main').css({
                        'display': 'block'
                    });
                    if ($boxRatio < $aspectRatio) { // If the screen ratio is less than the aspect ratio..
                        // Set the width of the video to the screen size multiplied by $adjRatio
                        $vid = $('#container video').css({
                            'width': $width * $adjRatio + 'px'
                        });
                    } else {
                        // Else just set the video to the width of the screen/container
                        $vid = $('#container video').css({
                            'width': $width + 'px'
                        });
                    }

                })(); // Run function immediately

                // Run function also on window resize.
                $(window).resize(adjSize);

            });

            // Wait until the video meta data has loaded
            $('#container1 video').on('loadedmetadata', function() {

                var $width, $height, // Width and height of screen
                    $vidwidth = this.videoWidth, // Width of video (actual width)
                    $vidheight = this.videoHeight, // Height of video (actual height)
                    $aspectRatio = $vidwidth / $vidheight; // The ratio the video's height and width are in

                (adjSize = function() { // Create function called adjSize

                    $width = $(window).width(); // Width of the screen
                    $height = $(window).height(); // Height of the screen

                    $boxRatio = $width / $height; // The ratio the screen is in

                    $adjRatio = $aspectRatio / $boxRatio; // The ratio of the video divided by the screen size

                    // Set the container to be the width and height of the screen
                    $('#container1').css({
                        'width': $width + 'px',
                        'height': $height + 'px'
                    });

                    if ($boxRatio < $aspectRatio) { // If the screen ratio is less than the aspect ratio..
                        // Set the width of the video to the screen size multiplied by $adjRatio
                        $vid = $('#container1 video').css({
                            'width': $width * $adjRatio + 'px'
                        });
                    } else {
                        // Else just set the video to the width of the screen/container
                        $vid = $('#container1 video').css({
                            'width': $width + 'px'
                        });
                    }

                })(); // Run function immediately

                // Run function also on window resize.
                $(window).resize(adjSize);

            });
        }

    });