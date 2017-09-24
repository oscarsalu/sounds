

    $(document).on('change', '#location_country_find',function() { 
        $("#location_country_find option:selected").each(function() {
            location_country = $('#location_country_find').val();
            // alert("The input value has changed. The new value is: " + location_country);
            $.ajax({
                url: base_url + 'the_total_tour/find_locations/find_state',
                type: 'POST',
                dataType: 'json',
                data: {
                    "csrf_test_name": records_per_page,
                    location_country: location_country,

                },
                success: function(data) {
                   if (data['status'] == 1) {
                        var state = data['locationst'];
                        var html = '<option>--Select--</option>';
                        for (val in state) {

                            html += '<option value="' + state[val]["state"] + '">' + state[val]["state"] + '</option>';

                        }

                        $("#location_state").html(html);
                    } else {
                        var city = data['locationst'];
                        var html = '<option>--Select--</option>';
                        for (val in city) {

                            html += '<option value="' + city[val]["city"] + '">' + city[val]["city"] + '</option>';

                        }

                        $("#location_city").html(html);
                    }
                },
            });
        });
    });
    //change sate
    $(document).on('change', '#location_state', function() {
        $("#location_state option:selected").each(function() {
            location_state = $('#location_state').val();
            // alert("The input value has changed. The new value is: " + location_state);
            $.post(base_url + 'the_total_tour/find_locations/find_city', { "csrf_test_name": records_per_page, location_state: location_state }, function(data) {
                //console.log(data);
                $("#location_city").html(data);
            });
        });
    });


function set_val(e, o) {
    $('#email_tos').val(e);
    $('#company').val(o.parent().find(".val_company").val());
}

function set_book_val(e, o) {
    $('#email_book').val(e);
    $('#company_book').val(o.parent().find(".val_company").val());
}
$("#find_location_form").submit(function() {
    //addContPromo($("#submit_contact"));
    return false;
});

function find_location(tour_id) {
    console.log("func call " + tour_id);
    $('#add_detail_location_new_find').modal('hide');
    var post_data = $("#form_tour_submit_find").serialize();
    
    post_data = post_data+ '&submit_form_find=' + $("#submit_form_find").val();
    console.log(post_data);
    $.ajax({
        url: base_url+'the_total_tour/find_locations/'+tour_id,
        type:'POST',
        data:post_data,
        dataType:'text',
        success: function(data) {
            console.log(data);
            $('div #find_locations').empty();
            $('div #find_locations').html(data);
            initialize_map() ;
        },
        error: function(error){

        }
        
    });

}

function view_location_modal_find() {
    $('#add_detail_location_new_find').modal('show');
};

function send_email_location(tour_id){
    $('#modal-id').modal('hide');
    var post_data = $("#send_email_location").serialize();
    $.ajax({
        url: base_url+'the_total_tour/find_locations/send_mail',
        type:'POST',
        data:post_data,
        dataType:'json',
        success: function(data) {
            console.log(data);
            if(data == 'success')
            {
                get_find_locations_view(tour_id);
            }
           
        },
        error: function(error){
        }
        
    });
}

function book_a_show_location(tour_id){
    $('#bookShow').modal('hide');
    var post_data = $("#book_show_location_form").serialize();
    $.ajax({
        url: base_url+'artist/showgigs/booking_request',
        type:'POST',
        data:post_data,
        dataType:'json',
        success: function(data) {
            get_find_locations_view(tour_id);
            
        },
        error: function(error){
            
        }
        
    });
}