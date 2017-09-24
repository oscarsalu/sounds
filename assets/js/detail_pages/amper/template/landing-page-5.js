    function playvideo(link_video,o){
        $link_vd = link_video;              
        var playerInstance = jwplayer("video");
        jwplayer("video").setup({
        	stretching: 'fill',
        	file: $link_vd,            	
            width: "100%",            
            aspectratio: "16:9"
        });   
        jwplayer("video").play();            
    }  
        $(document).ready(function() {
        $(".header_new_style").hover(function(){
            $(this).find(".remove_part").css("display","block");
        },function(){
            $(this).find(".remove_part").css("display","none");
        });
        $(".header_new_style .remove_part").click(function(){
            $(this).parent().slideUp();
        })
        $(".image_fix_value").click(function(){
            $(this).parent().find(".img-responsive").click();
        });      
    });