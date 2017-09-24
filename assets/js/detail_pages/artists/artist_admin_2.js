$(document).ready(function () {
	//MY PROFILE TABS 
	$('.tab-content').hide().first().show();
	$('.tabs li:first').addClass("active");

	$('.tabs a').on('click', function (e) {
		e.preventDefault();
		$(this).closest('li').addClass("active").siblings().removeClass("active");
		$($(this).attr('href')).show().siblings('.tab-content').hide();
	});

	var hash = $.trim( window.location.hash );
	if (hash) $('.tab-nav a[href$="'+hash+'"]').trigger('click');
    // Press popup 
    
    $( "#quote_remaining" ).keyup(function() {
        var len = $(this).val().length;
        if(len>1000){
             $(this).val($(this).val().substr(0, 1000));
             $( "#press_remaining" ).html(0);
        }else{
            $( "#press_remaining" ).html(1000-len);
        }
       
    });
	
});