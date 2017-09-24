 $('#submit_comment_rate').click(function(){   
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
                //console.log(data);
                if(data['status']=="not_comment_rate"){
                    $("#error_rate").show();
                     $("#error_rate").fadeOut(13000);
                }
                if(data['status']=="not_insert"){
                    $("#error_rate_inser").show();
                    $("#error_rate_inser").fadeOut(13000);
                }
                 if(data['status']=="oke_comment_rate"){
                    //$("#success_rate_inser").show();
                     var html='';
                     html += '<div class="list-group-item comment_height" id="dele_'+data['stt']+'">';
                     html += '<button type="button" class="close"  data-toggle="modal"  data-target="#modal_delete_comment" id="delete_comment" title="delete">&times;<input type="hidden" class="event_delete" value="'+data['event']+'" />';
                     html += '<input type="hidden" class="user_delete" value="'+data['user']+'" />';
                     html += '<input type="hidden" class="id_delete" value="'+data['stt']+'" /></button>';
                     html +='<img src="'+image+'" class="thumbnail img_left" alt="Avatar"/>';
                     html +='<a href="'+$url+data['name']+'" title="'+data['name']+'"><h3 class="list-group-item-heading">'+data['name']+'</h3></a><p>'+data['comment']+'</p></div>';                     
                     var data = $("#comment_star_"+event_comment).html();
                     var show = html+data;
                      $("#comment_star_"+event_comment).html(show);
                      $("#rate_venue").hide();
                     $(".modal-backdrop").hide(); 
                     $("#comment_star_"+event_comment).show();
                    
                }
                
                  
                                                                                         
            }
        });    
    });    
    
    
    //comment delete
    $('#button_delete_comment').click(function(){  
        var event_delete = $("#event_delete").val();
        var user_delete = $("#user_delete").val();
        var id_delete = $("#id_delete").val(); 
        var user_dele = $("#user_dele").val(); 
        //alert(user_delete);             
        $.ajax({
            url: $url+"artist/showgigs/delete",
            type: "post",
            data: {
                "event_delete":event_delete,"user_delete":user_delete,"id_delete":id_delete,"user_dele":user_dele,
                "csrf_test_name":$records_per_page
            },
            dataType: "json",               
            success:function(data){ 
                 //console.log(data);
              
                 if(data['status']=="oke_delete"){ 
                    $("#dele_"+data['event']).remove();
                    $("#modal_delete_comment").hide();
                    $(".modal-backdrop").hide(); 
                    $("#success_dele").show();
                }else{
                    $("#modal_delete_comment").hide();
                    $(".modal-backdrop").hide(); 
                    $("#erorr_delete").show()
                }
                
                  
                                                                                         
            }
        });    
    });    