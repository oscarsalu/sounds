$(document).ready(
	function() 
	{
		$("ul.messages-layout").niceScroll({
			cursorcolor: "#2f2e2e",
			cursoropacitymax: 0.6,
			boxzoom: false,
			touchbehavior: false
		});
		
		$("ul.messages-layout").scroll(function()
		{
		  $(this).getNiceScroll().resize();
		});
		
		$("ul.messages-layout").animate({ scrollTop: 999999 }, 'fast');
	}
);