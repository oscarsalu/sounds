<div class="container">
<?php if(count($locations)){
    ?>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Location</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table">
                        <tr>
                            <td><label> LOCATON: </label></td>
                            <td>
                                <select class="selectschedulelocation">
                                <?php foreach ($locations as $location) {
    ?>
                                    <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';
    $location_name = $location['location'];
    } ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                <?php 
    } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="weatherScheduleSpan text-center"></div>
                                <br>
                                <div class="weatherScheduleCls"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="x_panel tile  overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Weekly Schedules of <cite><?=$location_name?></cite></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="calendarschedule"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}else {
?>
<div class="row text-center">
    <div class="panel panel-danger">
        <div class="panel-heading ">
            <strong> Select Location first <strong> 
        </div>
    </div>
    
</div>
<?php
}
?>
</div>

<!-- added on Event -->
<div id="form-modal-schedule" class="modal fade new_modal_style" role="dialog">
    <div class="modal-dialog">
          <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title tt"><!-- title will apear here --></h4>
                <span class="liner"></span>
            </div>
            <div id="tabs">
                <div id="tabs-1">
                    <form id="form_schedule_submit" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <input type="hidden" class="type_event" name="type" value="add" />
                        <input type="hidden" class="event_id" name="event_id" value="" />
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-input col-md-3">Tour:</label>
                                <div class="input-group col-md-8">
                                    <input type="text" class="form-control" name="tour_event_name" id="tour_event_name" value="<?php echo $tour['tour'];?>" />
                                    <input type="hidden" name="tour_event_id" id="tour_event_id" value="<?php echo $tour_id;?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-input col-md-3">Location:</label>
                                <div class="input-group col-md-8">
                                    <input type="text" class="form-control" name="location_event_name" id="location_event_name" value="" />
                                    <input type="hidden" name="location_event_id" id="location_event_id" value="<?php echo $location_id;?>" />
                                    <input type="hidden" name="start_event_id" id="start_event_id" value="" />
                                    <input type="hidden" name="end_event_id" id="end_event_id" value="" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-input col-md-3">Schedules Title:</label>
                                <div class="input-group col-md-8">
                                    <input type="text" class="form-control" name="event_title" id="event_title" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-input col-md-3">Schedules color:</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group colorpicker">
                                        <input class="color_front form-control" type="text" name="color_front" id="color_pic" value="" class="form-control" />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer searchform">
                          <img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
                          <input type="button" class="btn btn-success excel-go" id="submit_form" value="Submit" onclick="add_schedule(<?=$tour_id;?>, <?=$location_id;?>)" />
                          <input type="button" class="delete_data" value="Delete" onclick="delete_shcdule(<?php echo $tour_id;?>, <?php echo $location_id;?>)"/>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>


<script>
        "use strict";
        $(function() {
          // Code for docs demos
          function createColorpickers() {
            
            $(function(){
                $('.colorpicker').colorpicker();
                
            });
          }
          createColorpickers();
        });
        $('.colorpicker').on('hidePicker', function(event) {
        });

</script>
    
<script>

var tour_id = <?=$tour_id?>;


</script>


<script type="text/javascript"> 
/* fullcalender start*/
  $("#daily_schedules").ready(function() {
    console.log("ready schedule");
    $('#calendarschedule').fullCalendar({ 
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        timeFormat: {
            agenda: 'HH(:mm)' //h:mm{ - h:mm}'
        },
        //timeFormat: 'H(:mm)', // uppercase H for 24-hour clock
        defaultDate: '<?php echo date('Y-m-d'); ?>',
        selectable: true,
        displayEventTime: true,
        selectHelper: true,
        slotLabelFormat:"HH:mm",
        select: function(start, end) {
            // var title = prompt('Event Title:');
            var title = <?php if ($check_member['manager_schedule']) {
    ?>create_schedule('new',start, end);<?php 
} else {
    ?>'';<?php 
}?>
            var eventData;
            
            if (title) {
                eventData = {
                title: title,
                start: start,
                end: end
                };
                $('#calendarschedule').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendarschedule').fullCalendar('unselect');
        },
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: [
        <?php
        foreach ($schedules as $schedule) {
            ?>
            {
                title: '<?php echo $schedule['des']; ?>',
                start: '<?php echo date('M d Y h:i:s A', $schedule['start_time']); ?>',
                end: '<?php echo date('M d Y h:i:s A', $schedule['end_time']); ?>',
                <?php if ($check_member['manager_schedule']) {
    ?>url:'javascript:create_schedule(\'edit\',\'<?php echo date('M d Y h:i:s A', $schedule['start_time']); ?>\',\'<?php echo date('M d Y h:i:s A', $schedule['end_time']); ?>\',<?php echo $schedule['id']; ?>)',<?php 
} ?>
                color: '<?php echo $schedule['color']; ?>',
            },
        <?php 
        }?>
        /*{
            title: 'All Day Event',
            start: '2016-06-01T14:30:00',
        
        },
        {
            title: 'Long Event',
            start: 'jun 01 2016 09:30:00',
            end: 'jun 02 2016 09:30:00',
            color: '#257e4a',
        
        },*/
        
        ]
    });
    $.ajax({
        url: base_url + 'the_total_tour/get_location_via_id',
        data: {
            'csrf_test_name': get_csrf_hash,
            location_id: <?=$location_id?>,
            json: 1,
        },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            
            weatherScheduleForcast(data.location.city);
        }
    });
}); 
function conf_del(msg){ 
    if(confirm(msg))
        return true;  
    else
        return false;
}
function weatherScheduleForcast(location)
{
    var weatherData;
    $.ajax({
        url: "http://api.openweathermap.org/data/2.5/weather?q=" + location + "&appid=9cafd4417bbbba3da7ab3a2ab9d06a4c&units=metric",
        success: function(data) {
            if (data.message) {
                weatherData = "No data found";
            } else {
                weatherData = "<div class='col-md-4' style='padding-top:20px'>" +
                    "<img src='http://openweathermap.org/img/w/" + data.weather[0].icon + ".png'>" +
                    "</div>" +
                    "<div class='col-md-8'>" +
                    "<div>" + data.weather[0].description + "</div>" +
                    "<div>Tempreture: " + data.main.temp + " &degC</div>" +
                    "<div>Humidity: " + data.main.humidity + "% </div>" +
                    "<div>Wind: " + data.wind.speed + "m/s </div>" +
                    "</div>";
            }
            $('.weatherScheduleSpan').html(location + " : Weather Forecast");
            $('.weatherScheduleCls').html(weatherData);

        }
    });
}
function event_info(msg){
    alertify.alert(msg);
}
// $(".delete_data").click(function(){
//     if(conf_del("Are you sure delete!")){
//         $('#form-modal-schedule').find("#form_schedule_submit").find(".type_event").val("delete");
//         $('#form-modal-schedule').find('#form_schedule_submit').submit();
//     }
// });
function create_schedule(type,start, end,id){
    
    var tmp = '';
    if(type=='edit')
    {
        $('#form-modal-schedule').find('.modal-header').find('h4').html('Edit Schedules');
        $('#form-modal-schedule').find('.modal-footer').find('#form_schedule_submit').attr('value','Edit Schedules');
        //$('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#location_event_id").val($("#location_all").val());
        $('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#location_event_name").val($('.selectschedulelocation :selected').text());
        $('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#start_event_id").val(start);
        $('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#end_event_id").val(end);
        $('#form-modal-schedule').find("#form_schedule_submit").find(".type_event").val("edit");
        $('#form-modal-schedule').find("#form_schedule_submit").find(".event_id").val(id);
        $('#form-modal-schedule').find("#form_schedule_submit").find(".delete_data").css("display","inline");
        
        $.ajax({
          url:'<?php echo base_url('more_ttt/get_schedule') ?>',
          data: { id: id,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
          type:'POST',
          dataType:'json',
          success: function(data){
            $('#form-modal-schedule').find("#form_schedule_submit").find("#event_title").val(data.data.des);
            $("#color_pic").val(data.data.color);
            console.log($("#color_pic").val());
            $("#color_pic").val(data.data.color);
            console.log(data.data.color);

          }
        });
        $('#form-modal-schedule').modal('show');
    }
    else if(type=='new')
    {
        $('#form-modal-schedule').find("#form_schedule_submit").find(".delete_data").css("display","none");
        $('#form-modal-schedule').find('.modal-header').find('h4').html('Add Schedules');
        $('#form-modal-schedule').find('.modal-footer').find('#form_schedule_submit').attr('value','Add Schedules');
        //$('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#location_event_id").val($("#location_all").val());
        $('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#location_event_name").val($('.selectschedulelocation :selected').text());
        $('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#start_event_id").val(start);
        $('#form-modal-schedule').find("#form_schedule_submit").find('.modal-body').find("#end_event_id").val(end);
        $('#form-modal-schedule').find("#form_schedule_submit").find(".type_event").val("add");
        
        $('#form-modal-schedule').find("#form_schedule_submit").find("#event_title").val("");
        $('#form-modal-schedule').find("#form_schedule_submit").find("#event_desc").val("");
        $('#form-modal-schedule').modal('show');
    }
    
    
}

function add_schedule(tour_id, location_id){
    $("#form-modal-schedule").modal('hide');
    var post_data = $('#form_schedule_submit').serialize();
    
    $.ajax({
        url: base_url+'more_ttt/data_schedule',
        type:'POST',
        data:post_data,
        dataType:'json',
        success: function(data) {
            console.log("success");
            console.log(data);
            get_daily_schedules_view_tour_location(tour_id, location_id);
        },
        error: function(error){
            console.log(error);
            console.log("errei");
        }
        
    });
}
function delete_shcdule(tour_id, location_id)
{
    
    if(conf_del("Are you sure delete!")) {
        
        $('#form-modal-schedule').find("#form_schedule_submit").find(".type_event").val("delete");
        var post_data = $('#form_schedule_submit').serialize();
    
        $.ajax({
            url: base_url+'more_ttt/data_schedule',
            type:'POST',
            data:post_data,
            dataType:'json',
            success: function(data){
                get_daily_schedules_view_tour_location(tour_id, location_id);
            },
            error: function(error){

            }
            
        });
        $("#form-modal-schedule").modal('hide');
    }
    
}
</script>
