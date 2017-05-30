$(document).ready(function() {
    $("form.bios-form").submit(function(e){
		e.preventDefault();
        var uri = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: uri,
            data: {
                'bios':   CKEDITOR.instances['text_bio'].getData(),
                'csrf_test_name':get_csrf_hash  
            },
            dataType: "text",
            success: function(response) {
                 $('.alert_panel').html(response); 
            }
        });    
    });
    $("a.get_ajax").click(function(e){
		e.preventDefault();
        var element = $(this).parent().parent().parent();
        var uri = $(this).attr('href');
        element.remove();
        $.ajax({
            type: "GET",
            url: uri,
            dataType: "text",
            success: function(response) {
                 $('.alert_panel').html(response); 
                 //element.remove();
                 
            }
        });  
          
        
    });
    //videos
  /*  $(".router-type input[name=router-type]").click(function(e){
        var value =  $(this).val();
        if(value=='link'){
            $('.form_video_link').show();
            $('.form_video_file').hide();
           // $('.form_video_file').resetForm();
        }else{
            $('.form_video_link').hide();
            //$('.form_video_link').resetForm();
            $('.form_video_file').show();
        }
    });
    $(".form_video_link").submit(function(e){
		e.preventDefault();
        var dataoj = $(this).serialize(); 
        var uri = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: uri,
            data: dataoj,
            dataType: "text",
            success: function(response) {
                 $('.alert_panel').html(response); 
                 //location.reload();
            }
        });    
    }); */
    //watch video 
   /* $(".watch_video").click(function(e){
       //e.preventDefault(); 
       var file_link = $(this).parent().find('.file_source').val();
       var playerInstance = jwplayer("video");
       jwplayer().load([{
            file: file_link
       }]);
       jwplayer().play();
    });
    jwplayer("video").setup({
    	stretching: 'fill',
    	file: 'https://www.youtube.com/watch?v=MWIO6C4Bcn0',
        width: "100%",
        aspectratio: "16:9"
    }); */
    //choose tpl
    $('#chooseLayout').on('click','ul li', function (){
        $( "#chooseLayout ul li" ).each(function() {
            $(this).removeClass("selected");
            $(this).addClass( "" );
        });
        $(this).addClass( "selected" );
        var tpl_vl = $(this).find('.hidden-val').val();
        var img = $(this).find('.hidden-img').val();;
        $( "#result-tpl" ).val(tpl_vl);
        //code did for image change
        $( "#result-img" ).val(img);
    });
    
    $('#chooseLayout').on('click','.changeimages', function (){
        var parent = $(this).parent();
        var src = parent.find('.hidden-img').val();
        $("#alp-pre-img").attr("src",src);
    });
    
    $(".form_tpl").submit(function(e){
		e.preventDefault();
        var dataoj = $(this).serialize(); 
        var uri = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: uri,
            data: dataoj,
            dataType: "text",
            success: function(response) {
                var tit = $( "#result-tpl" ).val();
                //code did for image change
                var img = $( "#result-img" ).val();
                $('#new-img ').attr('src', img);

                $('.alert_panel').html(response); 
                $('.current_tpl').html('Template '+tit);
                $('#chooseLayout').modal('hide');
            }
        });    
    });
});