	(function($){
		$(window).load(function(){
			var amount=Math.max.apply(Math,$("#content-1 li").map(function(){return $(this).outerWidth(true);}).get());
            var per_page=1;
			$("#content-1").mCustomScrollbar({
				axis:"x",
				theme:"inset",
				advanced:{
					autoExpandHorizontalScroll:true
				},
				scrollButtons:{
					enable:false,
					scrollType:"stepped"
				},
                callbacks:{
                    onTotalScroll:function(){
                      $.post( base_url+'fancapture/load_list_artist',
                            {   
                                'genre': genre,
                                'page': per_page +1, 
                                'csrf_test_name':get_csrf_hash
                            },
                            function(response){
                                $.each(response , function (index, value){
                                    if(index%2==0){
                                        print(value,1);
                                    }else{
                                        print(value,2);
                                    }
                                });  
                                per_page++;                                          
                            },
                            'json'
                        );  
                    },
                },
				keyboard:{scrollType:"stepped"},
				snapAmount:amount,
				mouseWheel:{scrollAmount:amount}
			});
		});
        
	})(jQuery);
function print(data,tag_ul){
    var res;
    $.post(base_url+'fancapture/call_print',
        {   
            'data': data, 
            'csrf_test_name':get_csrf_hash 
        },
        function(response){
            if(tag_ul==1){
                $(".tag_ul_1").append(response);
            }else{
                $(".tag_ul_2").append(response);
            }
        }
    );
}