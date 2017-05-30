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
            var id_event = $(this).attr('data-event');
            $.ajax({
                method: "GET",
                url: url+"gigs_events/getdata",
                dataType: 'json',
                data: { id: id_event}
            }).done(function( ev ) {
                $('#myModalevent').text('Event '+ev.title);
                $('#event_banner').attr('src',url+'uploads/'+ev.user_id+'/photo/banner_events/'+ev.event_banner);
                $('#start').text(ev.event_start_date);
                $('#end').text(ev.event_end_date);
                $('#post-b').text(ev.post_date);
                $('#lo').text(ev.location);
                $('#des').html(ev.event_desc);
                $('#cat').text(ev.genre);
            }).fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });                                     
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
}

 function play_vimeo_video(link_video){
    console.log(link_video);
    $link_vd = link_video;              
    $("#vimeo_video").attr("src", $link_vd);       
}

   