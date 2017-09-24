$(document).ready(function() {
    
     $('.list_affilaite').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var level = $(this).find(".level_data").val();
            var page = parseInt($(this).find(".level_page").val());
            var current = $(this);           
            $.ajax({             
                url: link+'amper/chat/load_level',
                type: "post",
                data: { 
                    'page' : page,
                    'level':level,
                    'csrf_test_name':get_csrf_hash
                },
                dataType: "json",               
                success:function(response){
                    $.each(response , function (index, value){
                       current.append(value);
                    });       
                    current.find(".level_page").val(page+1);                                                                                        
                }
            }); 
        }
    });
    $('.list_artist_chat').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var level = $(this).find(".level_data").val();
            var page = parseInt($(this).find(".level_page").val());
            var current = $(this);
           
            $.ajax({             
                url: link+'amper/chat/load_artist_chat',
                type: "post",
                data: { 
                    'page' : page,
                    'level':level,
                    'csrf_test_name':get_csrf_hash
                },
                dataType: "json",               
                success:function(response){
                    $.each(response , function (index, value){
                       current.append(value);
                    });       
                    current.find(".level_page").val(page+1);                                                                                        
                }
            }); 
        }
    });
    $('.list_recent_chat').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var page = parseInt($(this).find(".level_page").val());
            var current = $(this);
           
            $.ajax({             
                url: link+'amper/chat/load_recent_chat',
                type: "post",
                data: { 
                    'page' : page,
                    'csrf_test_name':get_csrf_hash
                },
                dataType: "json",               
                success:function(response){
                    $.each(response , function (index, value){
                       current.append(value);
                    });       
                    current.find(".level_page").val(page+1);                                                                                        
                }
            }); 
        }
    });
});
function load_iframe(id){
    
    //var link = '<?php //echo base_url()?>/chat/'+id;
    $("#frame").attr('src',link+'chat'+id);
}
function load_iframe_artist(id){
    //var link = '<?php //echo base_url()?>/chat/artist/'+id;
    $("#frame").attr('src',link+'chat/artist/'+id);
}