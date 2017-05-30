
    $('.type_value').change(function(){
        var type_value = $(this).val();
        if(type_value == 'field'){
            $(".description_show").slideDown();
            $(".checkbox_twitter").slideDown();
            $(".checkbox_google").slideDown();
            $(".checkbox_facebook").slideDown();
            $(".video_sesion").slideUp();
            $(".field_sesion").slideDown();
            if($("#facebook").is(':checked')){
                $(".field_sesion").slideDown();
            }else{
                $(".field_sesion").slideUp();
            }
            
        }else if(type_value == 'image'){
            $(".field_sesion").slideUp();
            $(".description_show").slideDown();
            $(".checkbox_google").slideUp();
            $(".checkbox_twitter").slideDown();
            $( "#google" ).prop( "checked", false );
            $(".video_sesion").slideUp();
            $(".photo_sesion").slideDown();
            $(".field_sesion").slideUp();
        }else if(type_value == 'video'){
            $(".field_sesion").slideUp();
            $(".description_show").slideUp();
            $(".photo_sesion").slideUp();
            $(".video_sesion").slideDown();
            $(".checkbox_twitter").slideUp();
            $(".checkbox_google").slideUp();
            $( "#facebook" ).prop( "checked", true );
            $( "#twitter" ).prop( "checked", false );
            $( "#google" ).prop( "checked", false );
            $(".field_sesion").slideUp();
        }
    });
    
    $('.post_photo').change(function(){
        var post_photo = $(this).val();
        if(post_photo == 'upload_photo'){
            $(".url_post_photo_input").slideUp();
            $(".url_photo_upload").slideDown();
        }else if(post_photo == 'url_photo'){
            $(".url_photo_upload").slideUp();
            $(".url_post_photo_input").slideDown();
        }
    });
    $('.video_post').change(function(){
        var video_post = $(this).val();
        if(video_post == 'upload_video'){
            $(".url_video_input").slideUp();
            $(".url_video_upload").slideDown();
        }else if(video_post == 'url_video'){
            $(".url_video_upload").slideUp();
            $(".url_video_input").slideDown();
        }
    });
    $('#facebook').change(function(){
        var type_value = $("#field").is(':checked');
        if($(this).is(':checked')){
            if(type_value == true){
                $(".field_sesion").slideDown();
            }
        }else{
            $(".field_sesion").slideUp();
        }
        
    });
    $('.no_upload_field_fb').change(function(){
        var no_upload_field_fb = $(this).val();
        if(no_upload_field_fb == 'no_upload_field_fb'){
            $(".url_post_field_input").slideUp();
            $(".upload_field_upload").slideUp();
        }else if(no_upload_field_fb == 'upload_field_fb'){
            $(".url_post_field_input").slideUp();
            $(".upload_field_upload").slideDown();
        }else if(no_upload_field_fb == 'url_field_fb'){
            $(".upload_field_upload").slideUp();
            $(".url_post_field_input").slideDown();
        }
    });
    
    //var twitterCheck = $('#twitter').prop("checked");
    
    
    //************************
    
