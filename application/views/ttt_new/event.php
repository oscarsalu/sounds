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
                <div class="x_content table-responsive">
                   <table class="table">
                        <tr>
                            <td><label> LOCATON: </label></td>
                            <td>
                                <select class="selecteventlocation">
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
                                <div class="weatherEventSpan text-center"></div>
                                <br>
                                <div class="weatherEventCls"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="x_panel tile  overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Calender Event of <cite><?=$location_name?></cite></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="calendarevent"></div>
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
<div id="form-modal-event" class="modal fade new_modal_style" role="dialog">
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
                    <form id="form_event_submit"  method="POST" enctype="multipart/form-data">
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
                                <label class="form-input col-md-3" for="event_desc">Categories*</label>
                                <div class="input-group col-md-8">
                                    <select class="form-control " id="categories" name="categories">
                                        <?php foreach ($genres as $genre) {
        ?>
                                            <option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
                                        <?php 
    }?>                        
                                    </select>                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-input col-md-3">Event Title:</label>
                                <div class="input-group col-md-8">
                                    <input type="text" class="form-control" name="event_title" id="event_title" />
                                </div>
                            </div>
                            <div class="form-group">                    
                                <label class="form-input col-md-3" for="event_banner">Choose a Image</label>
                                <div class="input-group col-md-8">
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" id="ev_banner" name="event_banner" />  
                                    </div>     
                                    <div class="input-group col-md-3 image_event">
                                        <img src="" width="70px" />
                                    </div>                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-input col-md-3">Event capacity:</label>
                                <div class="input-group col-md-8">
                                    <input type="number" class="form-control" name="event_capacity" id="event_capacity" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-input col-md-3">Event Description:</label>
                                <div class="input-group col-md-8">
                                    <textarea class="form-control" rows="10" cols="60" id="event_desc" name="event_desc" ></textarea>
                                    <span id="er-des"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer searchform">
                            <img src="<?php echo base_url() ?>dist/images/ajax-loader.gif" style="display:none" class='loading_img' />
                            <input type="button" class="btn btn-success excel-go" id="submit_form" value="Submit" onclick="add_event(<?php echo $tour_id;?>, <?php echo $location_id;?>)" />
                            <input type="button" class="delete_data" value="Delete" onclick="delete_event(<?php echo $tour_id;?>, <?php echo $location_id;?>)"/>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

<script>

var tour_id = <?=$tour_id?>;

</script>
<script type="text/javascript"> 
/* fullcalender start*/
  $("#manager_event").ready(function() {
    console.log("ready");
    $('#calendarevent').fullCalendar({ 
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        timeFormat: 'H(:mm)', // uppercase H for 24-hour clock
        defaultDate: '<?php echo date('Y-m-d'); ?>',
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            var title = <?php if ($check_member['manager_cacula']) {
    ?>create_event('new',start, end);<?php 
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
                $('#calendarevent').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendarevent').fullCalendar('unselect');
        },
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        events: [
        <?php
        foreach ($events as $event) {
            ?>
            {
                title: '<?php echo $event['event_title']; ?>',
                start: '<?php echo date('Y-m-d', strtotime($event['event_start_date'])); ?>',
                end: '<?php echo date('Y-m-d', strtotime($event['event_end_date'])); ?>',
                <?php if ($check_member['manager_cacula']) {
    ?>url:'javascript:create_event(\'edit\',\'<?php echo date('Y-m-d', strtotime($event['event_start_date'])); ?>\',\'<?php echo date('Y-m-d', strtotime($event['event_end_date'])); ?>\',<?php echo $event['event_id']; ?>)'<?php 
} ?>
            },
        <?php 
        }?>
        //{
//            title: 'All Day Event',
//            start: '2016-06-01T14:30:00',
//        
//        },
//        {
//            title: 'Long Event',
//            start: 'jun 01 2016 09:30:00',
//            end: 'jun 02 2016 09:30:00',
//            color: '#257e4a',
//        
//        },
        
        ]
    });
    
}); 

function conf_del(msg){ 
    if(confirm(msg))
        return true;  
    else
        return false;
}
function event_info(msg){
    alertify.alert(msg);
}

function create_event(type, start, end,id){
    
    var tmp = '';
    if(type=='edit'){
        $('#form-modal-event').find('.modal-header').find('h4').html('Edit Event');
        $('#form-modal-event').find('.modal-footer').find('#form_event_submit').attr('value','Edit Event');
        //$('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_id").val($("#location_all").val());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_name").val($('.selecteventlocation :selected').text());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#start_event_id").val(start);
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#end_event_id").val(end);
        $('#form-modal-event').find("#form_event_submit").find(".type_event").val("edit");
        $('#form-modal-event').find("#form_event_submit").find(".event_id").val(id);
        $('#form-modal-event').find('form').attr('action','<?php echo base_url() ?>members/data_event');
        $('#form-modal-event').find("#form_event_submit").find(".delete_data").css("display","inline");
        
        
        $.ajax({
          url:'<?php echo base_url('members/get_event') ?>',
          data: { id: id,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
          type:'POST',
          dataType:'json',
          success: function(data){
            $('#form-modal-event').find("#form_event_submit").find('.modal-body').find('#categories').val(data.data.categories).trigger('change');
            $('#form-modal-event').find("#form_event_submit").find("#event_title").val(data.data.event_title);
            $('#form-modal-event').find("#form_event_submit").find("#event_capacity").val(data.data.capacity);
            
            $('#form-modal-event').find("#form_event_submit").find("#event_desc").val(data.data.event_desc);
            $('#form-modal-event').find("#form_event_submit").find(".image_event").find("img").attr("src","<?php echo base_url().'uploads/'.$user_data['id'].'/photo/banner_events/';  ?>"+data.data.event_banner);
            $('#form-modal-event').find("#form_event_submit").find(".image_event").css("display","inherit");
            $('#form-modal-event').find("#form_event_submit").find(".nicEdit-main").html(data.data.event_desc);
            
          }
        });
        
    }else if(type=='new'){
        $('#form-modal-event').find("#form_event_submit").find(".delete_data").css("display","none");
        $('#form-modal-event').find('.modal-header').find('h4').html('Add Event');
        $('#form-modal-event').find('.modal-footer').find('#form_event_submit').attr('value','Add Event');
        //$('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_id").val($("#location_all").val());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_name").val($('.selecteventlocation :selected').text());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#start_event_id").val(start);
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#end_event_id").val(end);
        $('#form-modal-event').find("#form_event_submit").find(".type_event").val("add");
        $('#form-modal-event').find("#form_event_submit").find(".nicEdit-main").html("");
        
        $('#form-modal-event').find("#form_event_submit").find("#event_title").val("");
        $('#form-modal-event').find("#form_event_submit").find("#event_desc").val("");
        $('#form-modal-event').find("#form_event_submit").find(".image_event").find("img").attr("src","");
        $('#form-modal-event').find("#form_event_submit").find(".image_event").css("display","none");


    }
    $('#form-modal-event').find('form').attr('action','<?php echo base_url() ?>members/data_event');
    
    $('#form-modal-event').modal('show');
}
function add_event(tour_id, location_id)
{
    $("#form-modal-event").modal('hide');
    var post_data = $('#form_event_submit').serialize();
    
    $.ajax({
        url: base_url+'members/data_event',
        type:'POST',
        data:post_data,
        dataType:'json',
        success: function(data){
            get_manager_event_view_tour_location(tour_id, location_id);
        },
        error: function(error){

        }
        
    });
}

function delete_event(tour_id, location_id)
{
    
    if(conf_del("Are you sure delete!")) {
        
        $('#form-modal-event').find("#form_event_submit").find(".type_event").val("delete");
        var post_data = $('#form_event_submit').serialize();
    
        $.ajax({
            url: base_url+'members/data_event',
            type:'POST',
            data:post_data,
            dataType:'json',
            success: function(data){
                get_manager_event_view_tour_location(tour_id, location_id);
            },
            error: function(error){

            }
            
        });
        $("#form-modal-event").modal('hide');
    }
    
}
$(document).ready(function(){


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
            weatherForecastEvent(data.location.city);

        }
    });
});

function weatherForecastEvent(location) {
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
            $('.weatherEventSpan').html(location + " : Weather Forecast");
            $('.weatherEventCls').html(weatherData);

        }
    });
}
</script>
