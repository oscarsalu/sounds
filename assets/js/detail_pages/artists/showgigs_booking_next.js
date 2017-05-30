function set_val_book(e,o){
        $('#tour_booking').val(e);
        $('#location_booking').val(o.parent().find(".val_location").val());
        $('#tour_booking').val(o.parent().find(".val_tour").val());
        $('#user_booking').val(o.parent().find(".val_user").val());
    };
function set_val_info(e,o){
        $('#event_info').val(e);
        event =   $('#event_info').val();
        $('#val_title').val(o.parent().find(".val_title").val());
        title = $('#val_title').val()
        $('#val_location').val(o.parent().find(".location_val").val());
        location_val = $('#val_location').val();
        $('#val_start').val(o.parent().find(".val_start").val());
        start = $('#val_start').val();
        $('#val_end').val(o.parent().find(".val_end").val());
        end_date = $('#val_end').val(); 
        var html = '<div class="panel panel-primary"><div class="row list-group-item list-group-item-success"><div class="col-md-4"><h3>Title:</h3></div><div class="col-md-8"><h2>'+title+'</h2></div></div><div class="row list-group-item"><div class="col-md-4"><h3>Start Date:</h3></div><div class="col-md-8"><h3>'+start+'</h3></div></div><div class="row list-group-item"><div class="col-md-4"><h3>End Date:</h3></div><div class="col-md-8"><h3>'+end_date+'</h3></div></div><div class="row list-group-item"><div class="col-md-4"><h3>Location:</h3></div><div class="col-md-8"><h3>'+location_val+'</h3></div></div></div>';
        $("#info_venues_show").html(html);
    };    
 function set_val_add_venues(e,o){
        $('#event_comment').val(e);
        $('#tour_comment').val(o.parent().find(".tour_comment_val").val());
        $('#location_comment').val(o.parent().find(".location_comment_val").val());       
    };   