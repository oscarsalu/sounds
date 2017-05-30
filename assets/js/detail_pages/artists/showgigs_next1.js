
$(document).ready(function() {  
        $('#showgigs').on('click','#button_comment_rate', function (){ 
                 var event = $(this).find('.event_rate').val();             
                 $("#event_comment").val(event);
                 var tour = $(this).find('.tour_rate').val();             
                 $("#tour_comment").val(tour);           
                 var location = $(this).find('.location_rate').val();             
                 $("#location_comment").val(location);
               });        
        $('#showgigs').on('click','#button_star_rate', function (){ 
                 var event = $(this).find('.event_rate').val();             
                 $("#event_star").val(event);
                 var tour = $(this).find('.tour_rate').val();             
                 $("#tour_star").val(tour);           
                 var location = $(this).find('.location_rate').val();             
                 $("#location_star").val(location);
               });   
        $('#showgigs').on('click','#submit_booking_request', function (){ 
                 var event = $(this).find('.location_booking').val();             
                 $("#location_booking").val(event);                   
                 var location = $(this).find('.tour_booking').val();             
                 $("#tour_booking").val(location);
                 var user = $(this).find('.user_booking').val();                                         
                 $("#user_booking").val(user);
               });      
        $('#showgigs').on('click','#delete_comment', function (){   
            var id = $(this).find('.event_delete').val();                
                $('#event_delete').val(id); 
                var ids = $(this).find('.user_delete').val();                
                $('#user_delete').val(ids); 
                 var idst = $(this).find('.id_delete').val();                
                $('#id_delete').val(idst); 
                }); 
    });     