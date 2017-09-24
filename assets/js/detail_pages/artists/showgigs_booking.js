 //booking_request
 $('#button_booking_request').click(function(){   
       //$id_unlock = $(this).find('input').val();
		if($('#email_book').val() && $('#email_book').val() == "NA")
		{
			alert("Admin not added email for this location..So you can't book venue");
			return false;
		}
		
        var user_booking      = $("#user_booking").val();
        var tour_booking      = $("#tour_booking").val();
        var location_booking  = $("#location_booking").val();
        var expected_draw     = $("#expected_draw").val();
        var email_booking     = $("#email_booking").val();
        var message_booking   = $("#message_booking").val();
        var contact_booking   = $("#contact_booking").val();
        var date_booking_from = $("#date_booking_from").val();
        var date_booking_to   = $("#date_booking_to").val();
        var template_num = $('#tpl_email').val();   
        var email_book = $('#email_book').val();       
        $.ajax({
            url: $url+"artist/showgigs/booking_request",
            type: "post",
            data: {
                "expected_draw":expected_draw,"email_booking":email_booking,"message_booking":message_booking,"contact_booking":contact_booking,"date_booking_from":date_booking_from,
                "date_booking_to":date_booking_to,"location_booking":location_booking,"tour_booking":tour_booking,"user_booking":user_booking,
                "csrf_test_name":$records_per_page,
                "template_num" : template_num,
                "email_book" : email_book,
            },
            dataType: "json",               
            success:function(data){ 
               // console.log(data);
                $('#email_book').val("");
                if(data['status']=="error_form"){
                     $("#error_form").show();
                     $("#error_form").fadeOut(13000);
                }
                if(data['status']=="error_sent_email"){
                    $("#error_email").show();
                    $("#error_email").fadeOut(13000);
                    
                }
                 if(data['status']=="success_sent_email"){
                    $("#success_sending").show();                   
                    $("#booking_request").hide();
                    $(".modal-backdrop").hide();
                }
                
                  
                                                                                         
            }//end function
        });    
    });    
 
