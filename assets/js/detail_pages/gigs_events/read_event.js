 $('#submit_comment_rate_read').click(function(){   
       //$id_unlock = $(this).find('input').val();
        var comment_rate = $("#comment_rate").val();
        var user_comment = $("#user_comment").val();
        var event_comment = $("#event_comment").val();
        var tour_comment = $("#tour_comment").val();
        var location_comment = $("#location_comment").val();         
        $.ajax({
            url: $url+"artist/showgigs/rate_venue",
            type: "post",
            data: {
                "comment_rate":comment_rate,"user_comment":user_comment,"event_comment":event_comment,"tour_comment":tour_comment,"location_comment":location_comment,
                "csrf_test_name":$records_per_page
            },
            dataType: "json",               
            success:function(data){ 
                $("#comment_rate").val('');
                if(data['status']=="not_comment_rate"){
                    $("#error_rate").show();
                     $("#error_rate").fadeOut(13000);
                }
                if(data['status']=="not_insert"){
                    $("#error_rate_inser").show();
                    $("#error_rate_inser").fadeOut(13000);
                }
                 if(data['status']=="oke_comment_rate"){
                    $("#success_rate_inser").show();
                    
                     var html='';
                     html += '<div class="list-group-item comment_height" id="dele_'+data['stt']+'">';
                     html += '<button type="button" class="close"  data-toggle="modal" style="padding: 10px;"  data-target="#modal_delete_comment_event" id="delete_comment_read" title="Delete">&times;<input type="hidden" class="event_delete" value="'+data['event']+'" />';
                     html += '<input type="hidden" class="user_delete" value="'+data['user']+'" />';
                     html += '<input type="hidden" class="id_delete" value="'+data['stt']+'" /></button>';
                     html +='<img src="'+image+'" class="thumbnail img_left" alt="Avatar"/>';
                     html +='<a href="'+$url+data['name']+'" title="'+data['name']+'"><h3 class="list-group-item-heading">'+data['name']+'</h3></a><p class="text-overflow">'+data['comment']+'</p></div>';                     
                   
                      $("#comment_star_"+event_comment).append(html);
                    
                }
                
                  
                                                                                         
            }
        });    
    });    
    
    
    //comment delete
    $('#button_delete_comment_event').click(function(){ 
        var delete_id_read = $("#delete_id_read").val(); 
        //alert(user_delete);             
        $.ajax({
            url: $url+"gigs_events/read_delete",
            type: "post",
            data: {
                "delete_id_read":delete_id_read, "csrf_test_name":$records_per_page
            },
            dataType: "json",               
            success:function(data){ 
                 //console.log(data);
                 if(data['oke_delete']=="ok"){ 
                    alert("Delete successfully.");
                    $("#dele_"+delete_id_read).remove();
                    $("#modal_delete_comment_event").hide();
                    $(".modal-backdrop").hide();
                    
                }else{
                    $("#modal_delete_comment_event").hide();
                    $(".modal-backdrop").hide(); 
                    alert("You can't delele");
                }
                                                                                     
            }
        });    
    });    