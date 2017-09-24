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
        })
        
        $('.show_ev').click(function (){
            var url = base_url;
            var id = $(this).find('#event_id').val();
            var title = $(this).find('#event_title').val();
            var des = $(this).find('#event_desc').val();
            var post = $(this).find('#posted_by').val();            
            var start_date = $(this).find('#event_start_date').val();
            var end_date = $(this).find('#event_end_date').val();
            var location = $(this).find('#location').val();
            var banner = $(this).find('#banner').val();            
            var cate = $(this).find('#categories').val();
            
            $('#myModalevent').text('Event '+title);
            $('#event_banner').attr('src',url+'uploads/'+id+'/photo/banner_events/'+banner);
            $('#start').text(start_date);
            $('#end').text(end_date);
            $('#post-b').text(post);
            $('#lo').text(location);
            $('#des').text(des)
                          
            if(cate == 1){
                $('#cat').text('ROCK');
            }else if(cate == 2){
                $('#cat').text('DANCE');
            }else if(cate == 3){
                $('#cat').text('POP');
            }else if(cate == 4){
                $('#cat').text('R&B');
            }else if(cate == 5){
                $('#cat').text('DJ');
            }else if(cate == 6){
                $('#cat').text('CHILDREN');
            }else if(cate == 7){
                $('#cat').text('FESTIVALS');
            }else if(cate == 8){
                $('#cat').text('PUNK AND HARDCORE');
            }else if(cate == 9){
                $('#cat').text('STAFF PICKS');
            }                                           
        });        
    }); 
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
     $(".effect_slide").click(function(){
            $(this).parent().parent().find("img").click();
        })
        