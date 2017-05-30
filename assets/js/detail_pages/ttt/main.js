function show_edit_member(o) {
    var id_member = o.parent().find(".save_id").val();
    $.ajax({
        url: base_url + 'members/getdatamember',
        data: { id_member: id_member, "csrf_test_name": records_per_page },
        type: 'POST',
        dataType: 'json',
        success: function(data) {

            $(".member_id_data").val(id_member);
            if (data['status']) {
                $(".cont_tele1").val(data['data']['tele']);
                $(".cont_email1").val(data['data']['email']);
                $(".color_front1").val(data['data']['color_front']);
                $(".cont_date1").val(data['data']['date']);
                $(".cont_name1").val(data['data']['name']);
                $(".cont_address1").val(data['data']['address']);
                $(".cont_reserv1").val(data['data']['reserv']);
                $(".cont_press1").val(data['data']['press']);
                $(".cont_addInfo1").val(data['data']['addInfo']);
                if(data['data']['manager_member'] == 1){
                    $( ".manager_member1" ).prop( "checked", true );
                }else{
                    $( ".manager_member1" ).prop( "checked", false );
                }
                if(data['data']['manager_event'] == 1){
                    $( ".manager_event1" ).prop( "checked", true );
                }else{
                    $( ".manager_event1" ).prop( "checked", false );
                }
                if(data['data']['manager_cacula'] == 1){
                    $( ".manager_cacula1" ).prop( "checked", true );
                }else{
                    $( ".manager_cacula1" ).prop( "checked", false );
                }
                if(data['data']['manager_schedule'] == 1){
                    $( ".manager_schedule1" ).prop( "checked", true );
                }else{
                    $( ".manager_schedule1" ).prop( "checked", false );
                }
                if(data['data']['type'] == "admin"){
                    $(".disable_div").css("display",'none');
                }else{
                    $(".disable_div").css("display",'block');
                }
                if(data['data']['add_expense'] == 1){
                   $( ".add_expense1" ).prop( "checked", true );
                }else{
                   $( ".add_expense1" ).prop( "checked", false );
                }
            }
        }
    });

    $("#edit-member-modal").modal('show');
    return false;
}

$("#cont_date1").datepicker();

$(".showaddcontact label a"). click(function(){
    $(".wp_showaddcontact").toggle();
    return false;
});
$(document).on('submit', "#cont_promo1", function(e) {
    e.preventDefault();

    addContPromo($("#submit_contact"));
    return false;
});
function delete_member(o,name){
    var id = o.parent().find(".save_id").val();
    if(id && conf_del('Are you sure to delete '+ name)){
          $.ajax({
          url:base_url+'members/delete_member',
          data: { id: id,"csrf_test_name":records_per_page},
          type:'POST',
          dataType:'json',
          success: function(data){
            if(data['status']){
                alertify.success(data['msg']);
                o.parent().parent().remove();
            }else{
              alertify.error(data['msg']);
            }
          }
        });
      }
    }

function conf_del(msg){ 
    if(confirm(msg))
        return true;  
    else
        return false;
}
function addContPromo(o){
  if($( "#location_all" ).val() == ''){
        alertify.error("Can't save data while don't have any tour");
        return false;
  }  
  if($( ".cont_tele" ).val() == ''){
        alertify.error("Please insert Tel !");
        return false;
  } 
  if($( ".cont_email" ).val() == ''){
        alertify.error("Please insert Email !");
        return false;
  }
  if($( ".cont_date" ).val() == ''){
        alertify.error("Please insert Date !");
        return false;
  }
  if($( ".cont_name" ).val() == ''){
        alertify.error("Please insert Name !");
        return false;
  }
  if($( ".cont_address" ).val() == ''){
        alertify.error("Please insert Address !");
        return false;
  }
    if ($('.manager_member').is(":checked"))
    {
        var manager_member = 1;
    }else{
        var manager_member = 0;
    }
    if ($('.manager_event').is(":checked"))
    {
        var manager_event = 1;
    }else{
        var manager_event = 0;
    }
    if ($('.manager_cacula').is(":checked"))
    {
        var manager_cacula = 1;
    }else{
        var manager_cacula = 0;
    }
    if ($('.manager_schedule').is(":checked"))
    {
        var manager_schedule = 1;
    }else{
        var manager_schedule = 0;
    }
    if ($('.expenseAdd').is(":checked"))
    {
        var add_expense = 1;
    }else{
        var add_expense = 0;
    }
  $.ajax({
    url:base_url+'the_total_tour/addContPromo',
    data: 
    {
         "csrf_test_name":records_per_page,
         tour_id:$tour_id,
         location_id: 0,
         cont_tele: $( ".cont_tele" ).val(),
         cont_email: $( ".cont_email" ).val(),
         cont_name: $( ".cont_name" ).val(),
         cont_address: $( ".cont_address" ).val(),
         cont_reserv: $( ".cont_reserv" ).val(),
         cont_press: $( ".cont_press" ).val(),
         cont_addInfo: $( ".cont_addInfo" ).val(),
         cont_date: $( ".cont_date" ).val(),
         color_front: $( ".color_front" ).val(),
         manager_member:manager_member,
         manager_event:manager_event,
         manager_cacula:manager_cacula,
         manager_schedule:manager_schedule,
         add_expense : add_expense,
    },
    dataType:'json',
    type:'POST',
    success: function(data){
        if(data['status']){
            o.parent().find("input").each(function() {
                $( this ).val( "" );
                    $("#submit_contact").val("Add Contact/Promoter");
                });
                $( '#cont_promo1' ).each(function(){
			    		this.reset();
            });
            $( ".manager_member" ).prop( "checked", false );
            $( ".manager_event" ).prop( "checked", false );
            $( ".manager_cacula" ).prop( "checked", false );
            alertify.success(data['msg']);
        }else{
            alertify.error(data['msg']);
        }
        $(".wp_showaddcontact").toggle();
            // location.reload();
    },
  });
}

function update_member_info() {
    $("#edit-member-modal").modal('hide');
    var post_data = $('#update_member').serialize();

    $.ajax({
        url: base_url + 'members/update_member',
        type: 'POST',
        data: post_data,
        dataType: 'json',
        success: function(data) {
            get_manager_member_view($('#tours').val());
        },
        error: function(error) {

        }

    });
}
