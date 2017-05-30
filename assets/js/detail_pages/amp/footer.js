  jQuery(function($){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('.click-ft').click(function(event){
            event.preventDefault();
            $('.click-ft .chevron_up').toggleClass("hiden");
            $('.click-ft .chevron_down').toggleClass("show");
            $('.footer').toggleClass('active');
            $("body").animate({ scrollTop: 999999 }, 'slow');
        });
    })
    $(document).ready(function() {
         
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
        //$('#my-video').backgroundVideo({
            //pauseVideoOnViewLoss: false,
            //parallaxOptions: {
                //effect: 1
            //}
        //});
        
    });