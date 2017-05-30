var mapEvent = "";

function load_locations(o, data1, data2) {
    $(".tour_id_detail").val($('#tours').val());

    var value = o.val();

    $.ajax({
        url: base_url + 'more_ttt/get_city_from_country',
        type: 'POST',
        dataType: 'json',
        data: {
            'csrf_test_name': get_csrf_hash,
            value: value,
            data2: data2,
        },
        success: function(data) {
            if (data['status']) {
                var city = data['data'];
                var html = '<option>- Select -</option>';
                for (val in city) {

                    if (data2 == "street1") {
                        if (city[val][data2] == "") {
                            html += '<option value="' + city[val]["street2"] + '">' + city[val]["street2"] + '</option>';
                        } else {
                            html += '<option value="' + city[val][data2] + ' @ ' + city[val]["email"] + '">' + city[val][data2] + '</option>';
                        }
                    } else {
                        html += '<option value="' + city[val][data2] + '">' + city[val][data2] + '</option>';
                    }
                }
                $("#" + data1).html(html);
            } else {

            }
        },
    });
}

function delete_detail(o, id, type) {
    if (conf_del("Are you sure delete!")) {
        $.ajax({
            url: base_url + 'more_ttt/edit_detail_tour_delete',
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_test_name': get_csrf_hash,
                id: id,
            },
            success: function(data) {
                if (data['status']) {
                    $(".tour_tour_" + type).attr('onclick', "add_detail_tour($(this),0,'Add','" + type + "')");
                    $(".tour_tour_" + type).html("Add");
                    $(".tour_tour_" + type).val("Add");
                    $("." + type).css("display", "none");
                    alertify.success(data['msg']);
                    $(".show_" + type).html("");
                    $('#add_detail_tour').modal('hide');
                    o.css("display", "none");
                } else {
                    alertify.error(data['msg']);
                }
            },
        });
    }
}

function add_detail_tour(o, id, value, type) {

    $(".delete_detail").addClass(type);
    $('#add_detail_tour').modal('show');
    $(".tour_id_detail").val();

    var data_html = '';
    data_html += '<input type="hidden" id="type_detail" name="type" value="' + type + '" />';
    data_html += '<input type="hidden" id="value_detail" name="value" value="' + value + '" />';
    data_html += '<input type="hidden" id="id_detail" name="id_detail" value="" />';
    $('#add_detail_tour').find('.modal-title').html(value + " " + type);
    if (value == "Edit") {

        $.ajax({
            url: base_url + 'more_ttt/edit_detail_tour_view',
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_test_name': get_csrf_hash,
                id: id,

            },
            success: function(data) {

                if (data['status']) {
                    if (type == 'hotels') {
                        $("#id_detail").val(data['data']['id']);
                        $("#room_hotel_tour").val(data['data']['room']);
                        $("#name_hotel_tour").val(data['data']['detail']);
                        $("#add_hotel_tour").val(data['data']['address']);
                        $("#phone_hotel_tour").val(data['data']['phone']);
                        $("#website_hotel_tour").val(data['data']['website']);
                    } else if (type == 'transport') {
                        $("#name_hotel_tour").val(data['data']['detail']);
                    } else if (type == 'flight') {
                        $("#name_hotel_tour").val(data['data']['detail']);
                    }
                }
            },

        });
    } else {
        //o.attr('onclick',"add_detail_tour($(this),13,'Edit','hotels')");
    }

    if (type == 'hotels') {
        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="room_hotel_tour">Detail rooms </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="room_hotel_tour" name="room_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="name_hotel_tour">Hotel Name </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="name_hotel_tour" name="name_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="add_hotel_tour">Address </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="add_hotel_tour" name="add_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="phone_hotel_tour">Phone </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="phone_hotel_tour" name="phone_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="website_hotel_tour">Website </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="website_hotel_tour" name="website_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';
    } else if (type == 'transport') {
        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="name_hotel_tour">Detail transport</label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="name_hotel_tour" name="name_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<input type="hidden" class="form-control" id="website_hotel_tour" name="website_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="phone_hotel_tour" name="phone_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="add_hotel_tour" name="add_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="room_hotel_tour" name="room_hotel_tour" />';

    } else if (type == 'flight') {
        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="name_hotel_tour">Detail Flight</label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="name_hotel_tour" name="name_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<input type="hidden" class="form-control" id="website_hotel_tour" name="website_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="phone_hotel_tour" name="phone_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="add_hotel_tour" name="add_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="room_hotel_tour" name="room_hotel_tour" />';
    }


    $('#add_detail_tour').find('#form_content_data').html(data_html);


}

$(".tour_des").click(function() {
    if ($(this).val() == "Edit") {
        $("#event_desc_tour").val($(this).parent().find(".show_des").html());
    }
});

function delete_detail(o, id, type) {
    if (conf_del("Are you sure delete!")) {
        $.ajax({
            url: base_url + 'more_ttt/edit_detail_tour_delete',
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_test_name': get_csrf_hash,
                id: id,
            },
            success: function(data) {
                if (data['status']) {
                    $(".tour_tour_" + type).attr('onclick', "add_detail_tour($(this),0,'Add','" + type + "')");
                    $(".tour_tour_" + type).html("Add");
                    $(".tour_tour_" + type).val("Add");
                    $("." + type).css("display", "none");
                    alertify.success(data['msg']);
                    $(".show_" + type).html("");
                    $('#add_detail_tour').modal('hide');
                    o.css("display", "none");
                } else {
                    alertify.error(data['msg']);
                }
            },
        });
    }
}

function add_detail_tour(o, id, value, type) {

    $(".delete_detail").addClass(type);
    $('#add_detail_tour').modal('show');
    $(".tour_id_detail").val();

    var data_html = '';
    data_html += '<input type="hidden" id="type_detail" name="type" value="' + type + '" />';
    data_html += '<input type="hidden" id="value_detail" name="value" value="' + value + '" />';
    data_html += '<input type="hidden" id="id_detail" name="id_detail" value="" />';
    $('#add_detail_tour').find('.modal-title').html(value + " " + type);
    if (value == "Edit") {

        $.ajax({
            url: base_url + 'more_ttt/edit_detail_tour_view',
            type: 'POST',
            dataType: 'json',
            data: {
                'csrf_test_name': get_csrf_hash,
                id: id,

            },
            success: function(data) {

                if (data['status']) {
                    if (type == 'hotels') {
                        $("#id_detail").val(data['data']['id']);
                        $("#room_hotel_tour").val(data['data']['room']);
                        $("#name_hotel_tour").val(data['data']['detail']);
                        $("#add_hotel_tour").val(data['data']['address']);
                        $("#phone_hotel_tour").val(data['data']['phone']);
                        $("#website_hotel_tour").val(data['data']['website']);
                    } else if (type == 'transport') {
                        $("#name_hotel_tour").val(data['data']['detail']);
                    } else if (type == 'flight') {
                        $("#name_hotel_tour").val(data['data']['detail']);
                    }
                }
            },

        });
    } else {
        //o.attr('onclick',"add_detail_tour($(this),13,'Edit','hotels')");
    }

    if (type == 'hotels') {
        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="room_hotel_tour">Detail rooms </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="room_hotel_tour" name="room_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="name_hotel_tour">Hotel Name </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="name_hotel_tour" name="name_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="add_hotel_tour">Address </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="add_hotel_tour" name="add_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="phone_hotel_tour">Phone </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="phone_hotel_tour" name="phone_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="website_hotel_tour">Website </label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="website_hotel_tour" name="website_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';
    } else if (type == 'transport') {
        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="name_hotel_tour">Detail transport</label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="name_hotel_tour" name="name_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<input type="hidden" class="form-control" id="website_hotel_tour" name="website_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="phone_hotel_tour" name="phone_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="add_hotel_tour" name="add_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="room_hotel_tour" name="room_hotel_tour" />';

    } else if (type == 'flight') {
        data_html += '<div class="form-group">';
        data_html += '<label class="form-input col-md-3" for="name_hotel_tour">Detail Flight</label>';
        data_html += '<div class="input-group col-md-8">';
        data_html += '<input type="text" class="form-control" id="name_hotel_tour" name="name_hotel_tour" />';
        data_html += '</div>';
        data_html += '</div>';

        data_html += '<input type="hidden" class="form-control" id="website_hotel_tour" name="website_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="phone_hotel_tour" name="phone_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="add_hotel_tour" name="add_hotel_tour" />';
        data_html += '<input type="hidden" class="form-control" id="room_hotel_tour" name="room_hotel_tour" />';
    }


    $('#add_detail_tour').find('#form_content_data').html(data_html);


}

$(".tour_des").click(function() {
    if ($(this).val() == "Edit") {
        $("#event_desc_tour").val($(this).parent().find(".show_des").html());
    }
});
$("#form_tour_detail_submit").submit(function() {
    o = $(this);
    $.ajax({
        url: base_url + 'more_ttt/edit_detail_tour',
        type: 'POST',
        dataType: 'json',
        data: {
            'csrf_test_name': get_csrf_hash,
            tour_id: $('#add_detail_tour').find(".tour_id_detail").val(),
            name_hotel_tour: $('#add_detail_tour').find("#name_hotel_tour").val(),
            add_hotel_tour: $('#add_detail_tour').find("#add_hotel_tour").val(),
            phone_hotel_tour: $('#add_detail_tour').find("#phone_hotel_tour").val(),
            website_hotel_tour: $('#add_detail_tour').find("#website_hotel_tour").val(),
            type_detail: $('#add_detail_tour').find("#type_detail").val(),
            value_detail: $('#add_detail_tour').find("#value_detail").val(),
            room_hotel_tour: $('#add_detail_tour').find("#room_hotel_tour").val(),
            id_detail: $('#add_detail_tour').find("#id_detail").val(),
        },
        success: function(data) {
            var value_detail = $('#add_detail_tour').find("#value_detail").val();
            var type_detail = $('#add_detail_tour').find("#type_detail").val()
            $(".delete_detail").removeClass(type_detail);
            if (data['status']) {
                var html_delete = '<input type="button" class="btn btn-delete excel-go delete_detail" onclick="delete_detail($(this),' + data['insert'] + ',\'' + type_detail + '\')" value="Delete" />';

                $(".tour_tour_" + type_detail).parent().find(".delete_detail").remove();
                $(".tour_tour_" + type_detail).parent().append(html_delete);


                $(".tour_tour_" + type_detail).attr('onclick', "add_detail_tour($(this)," + data['insert'] + ",'Edit','" + type_detail + "')");
                $(".tour_tour_" + type_detail).html("Edit");
                $(".tour_tour_" + type_detail).val("Edit");
                $(".delete_detail").css("display", "inline");

                var html = "";
                html += '<p>' + $('#add_detail_tour').find("#room_hotel_tour").val() + '</p>';
                html += '<div><b>' + $('#add_detail_tour').find("#name_hotel_tour").val() + '</b></div>';
                html += '<div>' + $('#add_detail_tour').find("#add_hotel_tour").val() + '</div>';
                html += '<div>' + $('#add_detail_tour').find("#phone_hotel_tour").val() + '</div>';
                html += '<div style="color: green;">' + $('#add_detail_tour').find("#website_hotel_tour").val() + '</div>';
                html += '<hr />';
                $(".show_" + type_detail).html(html);

                o.find(".delete_detail").attr('onclick', 'delete_detail(' + data['insert'] + ',"' + type_detail + '")');

                alertify.success(data['msg']);
                $('#add_detail_tour').modal('hide');

            } else {
                alertify.error(data['msg']);
            }
        },

    });
    return false;
});

$("#form_tour_des_submit").submit(function() {
    $.ajax({
        url: base_url + 'more_ttt/edit_des_tour',
        type: 'POST',
        dataType: 'json',
        data: {
            'csrf_test_name': get_csrf_hash,
            tour_id: $('#form_tour_des_submit').find(".tour_id_des").val(),
            des: CKEDITOR.instances['event_desc_tour'].getData(),
        },
        success: function(data) {
            if (data['status']) {
                alertify.success(data['msg']);
                $('#uploadDescription').modal('hide');
                $(".tour_des").val("EDIT");
                $(".show_des").html(CKEDITOR.instances['event_desc_tour'].getData());
            } else {
                alertify.error(data['msg']);
            }
        },

    });
    return false;
});
$("#cont_date").datepicker();
/*- function of map creation-*/
function create_map() {
    if (!$('#location_all').val()) {
        $('#geocomplete').val('Canada');
    } else {

        $('#geocomplete').val($('#location_all :selected').text());
    }


    $("#geocomplete").geocomplete({
        map: ".map_canvas",
        details: "form ",
        markerOptions: {
            draggable: true
        }
    });

    $("#find").click(function() {
        $("#geocomplete").trigger("geocode");
    }).click();

    $("#reset").click(function() {
        $("#geocomplete").geocomplete("resetMarker");
        $("#reset").hide();
        return false;
    });

    $("#geocomplete").bind("geocode:dragged", function(event, latLng) {
        $("input[name=lat]").val(latLng.lat());
        $("input[name=lng]").val(latLng.lng());
        $("#reset").show();
        if ($("#location_all").val()) {
            edit_location_via_lat_lng(latLng.lat(), latLng.lng());
        } else {
            alertify.error('First Add A Location!!!');
            return false;
        }

    });

    $("#geocomplete").bind("geocode:click", function(event, latLng) {

        $("input[name=lat]").val(latLng.lat());
        $("input[name=lng]").val(latLng.lng());
        if ($("#location_all").val()) {
            edit_location_via_lat_lng(latLng.lat(), latLng.lng());
        } else {
            alertify.error('First Add A Location!!!');
            return false;
        }

    });

    $("#geocomplete").bind("geocode:result", function(event, latLng) {

        var map = $("#geocomplete").geocomplete("map"),
            marker = $("#geocomplete").geocomplete("marker");

        //there is only a single marker, use only a single infowindow
        if (!marker.get('infowindow')) {
            marker.set('infowindow', new google.maps.InfoWindow());
            google.maps.event.addListener(marker, 'click', function() {
                this.get('infowindow').open(map, this);
            });
        }
        marker.get('infowindow').close();
        map.setZoom(15);
        marker.setMap(map);
        var tour_id = $("#tours").val();
        var mapContent = '<div class="row"><h3>' + $("#location_all option:selected").text() + '</h3></div><div class="row"><a id="" class="btn btn-info" onclick="set_val_book(this.id,$(this))"  data-toggle="modal" href="#bookShow">Book Venue</a></div>'
        marker.get('infowindow').setContent(mapContent);

    });
}

function  set_val_book(tour_id, location_id) {
    console.log(tour_id);
    console.log(location_id);
}
function create_map_update() {
    if (!$('#location_all').val()) {
        $('#geocomplete').val('Canada');
    } else {
        $('#geocomplete').val($('#location_all :selected').text());
    }


    $("#geocomplete").geocomplete({
        map: ".map_canvas",
        details: "form ",
        markerOptions: {
            draggable: true
        }
    });

    $("#find").click(function() {
        $("#geocomplete").trigger("geocode");
    }).click();

    $("#reset").click(function() {
        $("#geocomplete").geocomplete("resetMarker");
        $("#reset").hide();
        return false;
    });

}


/* confirm method to ask user*/
function conf_del(msg) {

    if (confirm(msg))
        return true;
    else
        return false;
}

function event_info(msg) {
    alertify.alert(msg);
}
$(document).ready(function() {
    $("#location-div").niceScroll({
        cursorcolor: "#2f2e2e",
        cursoropacitymax: 0.6,
        boxzoom: false,
        touchbehavior: false,
        cursorwidth: 13,
    });
});

function edit_location_via_lat_lng(lat, lng) {
    $.ajax({
        url: base_url + 'the_total_tour/edit_location_via_lat_lng',
        type: 'POST',
        dataType: 'json',
        data: {
            'csrf_test_name': get_csrf_hash,
            location_id: $('#location_all').val(),
            location_name: $('#location_all :selected').text(),
            lat: lat,
            lng: lng,
        },
        success: function(data) {
            if (data['status']) {
                alertify.success(data['msg']);
                $('#form-modal').modal('hide');
                setTimeout(function() { get_location_update($('#tours').val()); }, 30);
            } else {
                alertify.error(data['msg']);
            }
        },
        complete: function(data) {

        }
    });
}

function change_location(location_id) {
    $.ajax({
        url: base_url + 'the_total_tour/get_location_via_id',
        data: {
            'csrf_test_name': get_csrf_hash,
            location_id: location_id,
            json: 1,
        },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            weatherForecast(data.location.city);
            if (data['status']) {
                if (data.location.email != "")
                    $('#email_book').val(data.location.email);
                else
                    $('#email_book').val("NA");
                var address = '';

                var reach_expenses_total = 0;
                var reach_htm = '';

                var des_expenses_total = 0;
                var des_htm = '';

                var income_total = 0;
                var income_htm = '';

                mj_get_tour_location(); // mj_function
            }

        }
    });
}

function delete_income(income_id, income_name, location_id) {
    if (income_id && conf_del('Are you sure to delete ' + income_name)) {
        $.ajax({
            url: base_url + 'the_total_tour/delete_income',
            data: {
                'csrf_test_name': get_csrf_hash,
                income_id: income_id,
                location_id: location_id,
                json: 1
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    alertify.success(data['msg']);
                    $('#form-modal').modal('hide');
                    setTimeout(function() { get_location($('#tours').val()); }, 30);
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    }
}

function delete_expense(expense_id, expense_name, location_id) {
    if (expense_id && conf_del('Are you sure to delete ' + expense_name)) {
        $.ajax({
            url: base_url + 'the_total_tour/delete_expense',
            data: {
                'csrf_test_name': get_csrf_hash,
                expense_id: expense_id,
                location_id: location_id,
                json: 1
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    alertify.success(data['msg']);
                    $('#form-modal').modal('hide');
                    setTimeout(function() { get_location($('#tours').val()); }, 30);
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    }
}

function appear_income_modal(type, fn_name, income_id, income_name, income_price) {
    if (!$('#tour').val() && !$('#location_all').val()) {
        alert('No Record Found!!!');
        return false;
    }
    var tmp = '';
    if (type == 'edit') {
        tmp += '<input type="text" id="income_name" name="income_name" value="' + income_name + '" class="form-control">';
        tmp += '<label for="income_price">Price</label><input type="text" id="income_price" name="income_price" value="' + income_price + '" class="form-control">';
        tmp += '<input type="hidden" name="income_id" value="' + income_id + '" id="expense_id">';
        $('#form-modal').find('.modal-header').find('h4').html('Edit Income');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Edit');
    } else if (type == 'new') {
        tmp += '<input type="text" id="income_name" name="income_name" class="form-control">';
        tmp += '<label for="income_price">Price</label><input type="text" id="income_price" name="income_price" class="form-control">';
        $('#form-modal').find('.modal-header').find('h4').html('Add Income');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Edit');
    }
    tmp += '<input type="hidden" name="location_id" value="' + $('#location_all').val() + '" id="location_id">';
    $('#form-modal').find('form').attr('action', base_url + 'the_total_tour/save_income');
    $('#form-modal').find('#form_content').html(tmp);
    $('#form-modal').modal('show');
}

function appear_expense_modal(type, fn_name, expense_type, expense_id, expense_name, expense_price) {
    if (!$('#tour').val() && !$('#location_all').val()) {
        alert('No Record Found!!!');
        return false;
    }
    var tmp = '';
    if (type == 'edit') {
        tmp += '<input type="text" id="expense_name" name="expense_name" value="' + expense_name + '" class="form-control">';
        tmp += '<label for="expense_price">Price</label><input type="text" id="expense_price" name="expense_price" value="' + expense_price + '" class="form-control">';
        tmp += '<input type="hidden" name="expense_id" value="' + expense_id + '" id="expense_id">';
        tmp += '<input type="hidden" name="location_id" value="' + $('#location_all').val() + '" id="location_id">';
        $('#form-modal').find('.modal-header').find('h4').html('Edit Expense');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Edit');
    } else if (type == 'new') {
        tmp += '<input type="text" id="expense_name" name="expense_name" class="form-control">';
        tmp += '<label for="expense_price">Price</label><input type="text" id="expense_price" name="expense_price" class="form-control">';
        tmp += '<input type="hidden" name="location_id" value="' + $('#location_all').val() + '" id="location_id">';
        tmp += '<input type="hidden" id="expense_type" name="expense_type" value="' + expense_type + '">';
        $('#form-modal').find('.modal-header').find('h4').html('Add Expense');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Add');
    }
    $('#form-modal').find('form').attr('action', base_url + 'the_total_tour/save_expense');
    $('#form-modal').find('#form_content').html(tmp);
    $('#form-modal').modal('show');
}

$("#cont_promo").submit(function() {
    //addContPromo($("#submit_contact"));
    return false;
});

function view_create_location_modal(type, fn_name) {
    $('#add_detail_location_new_create').modal('show');
}

function appear_expense_modal(type, fn_name, expense_type, expense_id, expense_name, expense_price) {
    if (!$('#tour').val() && !$('#location_all').val()) {
        alert('No Record Found!!!');
        return false;
    }
    var tmp = '';
    if (type == 'edit') {
        tmp += '<input type="text" id="expense_name" name="expense_name" value="' + expense_name + '" class="form-control">';
        tmp += '<label for="expense_price">Price</label><input type="text" id="expense_price" name="expense_price" value="' + expense_price + '" class="form-control">';
        tmp += '<input type="hidden" name="expense_id" value="' + expense_id + '" id="expense_id">';
        tmp += '<input type="hidden" name="location_id" value="' + $('#location_all').val() + '" id="location_id">';
        $('#form-modal').find('.modal-header').find('h4').html('Edit Expense');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Edit');
    } else if (type == 'new') {
        tmp += '<input type="text" id="expense_name" name="expense_name" class="form-control">';
        tmp += '<label for="expense_price">Price</label><input type="text" id="expense_price" name="expense_price" class="form-control">';
        tmp += '<input type="hidden" name="location_id" value="' + $('#location_all').val() + '" id="location_id">';
        tmp += '<input type="hidden" id="expense_type" name="expense_type" value="' + expense_type + '">';
        $('#form-modal').find('.modal-header').find('h4').html('Add Expense');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Add');
    }
    $('#form-modal').find('form').attr('action', base_url + 'the_total_tour/save_expense');
    $('#form-modal').find('#form_content').html(tmp);
    $('#form-modal').modal('show');
}

$("#cont_promo").submit(function() {
    //addContPromo($("#submit_contact"));
    return false;
});

function view_create_location_modal(type, fn_name) {
    $('#add_detail_location_new_create1').modal('show');
}



function delete_location() {
    if (!$('#location_all').val()) {
        alert('No Record Found!!!');
        return false;
    }
    if ($('#location_all').val() && conf_del('Are you sure to delete ' + $('#location_all :selected').text())) {
        $.ajax({
            url: base_url + 'the_total_tour/delete_location',
            data: { location_id: $('#location_all').val(), 'csrf_test_name': get_csrf_hash },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    alertify.success(data['msg']);
                    $('#form-modal').modal('hide');
                    setTimeout(function() { get_location($('#tours').val()); }, 30);
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    }
}

function delete_tour() {
    if (!$('#tours').val()) {
        alert('No Record Found!!!');
        return false;
    }
    if ($('#tours').val() && conf_del('Are you sure to delete ' + $('#tours :selected').text())) {
        $.ajax({
            url: base_url + 'the_total_tour/delete_tour',
            data: { tour_id: $('#tours').val(), 'csrf_test_name': get_csrf_hash },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    alertify.success(data['msg']);
                    $('#form-modal').modal('hide');
                    getdata_destinations();
                    checkNoTour();
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    }
}

function view_tour_modal(type, fn_name) {
    if (type == 'edit' && !$('#tours').val()) {
        alert('No Record Found!!!');
        return false;
    }
    var tmp = '';
    if (type == 'edit') {

        $("#tour_name_form").val($('#tours :selected').text());
        $("#tour_id_form").val($('#tours').val());
        $('#form-modal').find('.modal-header').find('h4').html('Edit Tour');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Edit');
    } else if (type == 'new') {
        console.log('new');
        //alert($("#tour_id_form").val());
        $("#tour_name_form").val('');
        $('#form-modal').find('.modal-header').find('h4').html('Add Tour');
        $('#form-modal').find('.modal-footer').find('#submit_form').attr('value', 'Add');
    }

    $('#form-modal').find('.modal-body').find('label').attr('for', 'tour_name').html('Tour');
    //$('#form-modal').find('#form_content').html(tmp);
    $('#form-modal').modal('show');
}
$("#form_tour_submit_data").submit(function() {
    if ($("#tour_name_form").val() != "") {

        var post_data = $(this).serialize();
        console.log(post_data);
        var url = $(this).attr("action");
        console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            data: post_data,
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    var tour_id = data['tour_id'];
                    alertify.success(data['msg']);
                    $('#form-modal').modal('hide');
                    getdata_destinations();
                    get_location(tour_id);
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    } else {
        alertify.error('Please insert tour name !');
    }
    return false;
});
$("#form_tour_submit_new1").submit(function() {

    if ($("#location_name").val() != '') {

        var post_data = $('#add_detail_location_new_create1').find('form').serialize();
        console.log(post_data);
        var url = $('#add_detail_location_new_create1').find('form').attr("action");

        $.ajax({
            url: url,
            type: 'POST',
            data: post_data,
            dataType: 'json',
            success: function(data) {

                console.log(data);
                if (data['status']) {
                    alertify.success(data['msg']);
                    $('#add_detail_location_new_create1').modal('hide');
                    get_location($('#tours').val()); //getdata_destinations();
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    } else if ($("#location_name").val()) {
        var post_data_value = $('#add_detail_location_new_create1').find('form').serialize();
        var url = $('#add_detail_location_new_create1').find('form').attr("action");
        $.ajax({
            url: url,
            type: 'POST',
            data: post_data_value,
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    alertify.success(data['msg']);
                    $('#add_detail_location_new_create1').modal('hide');
                    setTimeout(function() { get_location($('#tours').val()); }, 30);
                } else {
                    alertify.error(data['msg']);
                }
            },
            error: function(data) {


            }
        });
    }
    return false;
});
$("#form_tour_submit").submit(function() {

    if ($("#location_name").val() != '') {

        var post_data = $('#add_detail_location_new').find('form').serialize();
        var url = $('#add_detail_location_new').find('form').attr("action");
        $('#add_detail_location_new').modal('hide');
        $.ajax({
            url: url,
            type: 'POST',
            data: post_data,
            dataType: 'json',
            success: function(data) {

                console.log(data);
                if (data['status']) {
                    alertify.success(data['msg']);

                    get_location($('#tours').val()); //getdata_destinations();
                } else {
                    alertify.error(data['msg']);
                }
            }
        });
    } else if ($("#location_name").val()) {
        var post_data_value = $('#add_detail_location_new').find('form').serialize();
        var url = $('#add_detail_location_new').find('form').attr("action");
        $('#add_detail_location_new').modal('hide');
        $.ajax({
            url: url,
            type: 'POST',
            data: post_data_value,
            dataType: 'json',
            success: function(data) {
                if (data['status']) {
                    alertify.success(data['msg']);
                    // $('#add_detail_location_new').modal('hide');
                    setTimeout(function() { get_location($('#tours').val()); }, 30);
                } else {
                    alertify.error(data['msg']);
                }
            },
            error: function(data) {


            }
        });
    }
    return false;
});

function getdata_destinations() {
    $.ajax({
        url: base_url + 'the_total_tour/get_destinations',
        type: 'GET',
        success: function(data) {
            $("#tours").html(data);
        }
    });
}

function view_location_home_modal(type, fn_name) {
    console.log("called");
    if (type == 'edit' && !$('#location_all').val()) {
        alert('No Record Found!!!');
        return false;
    }
    $.ajax({
        url: base_url + 'more_ttt/show_location_db',
        data: { location_id: $('#location_all').val(), 'csrf_test_name': get_csrf_hash },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            var html = "<option>- Select -</option>";
            if (data['status']) {
                $.each(countries, function(key, value) {
                    var check = '';
                    if (data['data']['country'] == value) {
                        var check = 'selected="true"';
                    }
                    html += '<option ' + check + ' value="' + value + '">' + value + '</option>';
                });


                $("#location_country").html(html);
                var val;
                city = data['city'];
                var html = "<option>- Select -</option>";
                for (val in city) {
                    var check = '';
                    if (data['data']['city'] == city[val]['city']) {
                        var check = 'selected="true"';
                    }
                    html += '<option ' + check + ' value="' + city[val]['city'] + '">' + city[val]['city'] + '</option>';
                }
                $("#location_city").html(html);

                var val;
                address = data['address'];
                var html = "<option>- Select -</option>";
                for (val in address) {
                    var check = '';
                    if (data['data']['address'] == address[val]['street1']) {
                        var check = 'selected="true"';
                    }
                    html += '<option ' + check + ' value="' + address[val]['street1'] + '">' + address[val]['street1'] + '</option>';
                }
                $("#location_name").html(html);

            } else {
                //alertify.error(data['msg']);
            }
        }
    });
    $('#add_detail_location_new').modal('show');
}

function get_location(tour_id) {
    console.log("getlocation called");
    console.log(tour_id);
    $(".members_link").attr("href", base_url + "the_total_tour/members/" + tour_id);
    $(".caculate_link").attr("href", base_url + "the_total_tour/caculate/" + tour_id);
    $(".event_link").attr("href", base_url + "the_total_tour/event/" + tour_id);
    $(".schedules_link").attr("href", base_url + "the_total_tour/schedules/" + tour_id);
    $(".find_locations_link").attr("href", base_url + "the_total_tour/find_locations/" + tour_id);
    $(".social_media_link").attr("href", base_url + "the_total_tour/social_media/" + tour_id);
    $(".chat_members_link").attr("href", base_url + "the_total_tour/chat_members/" + tour_id);
    $(".roadtour_link").attr("href", base_url + "the_total_tour/roadtour/" + tour_id);
    $.ajax({
        url: base_url + 'the_total_tour/get_tour_chain_data',
        data: {
            tour_id: tour_id,
            'csrf_test_name': get_csrf_hash
        },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            
            var tmp = '';
            var address = '';
            var reach_expenses_total = 0;
            var reach_htm = '';

            var des_expenses_total = 0;
            var des_htm = '';

            var income_total = 0;
            var income_htm = '';
            var locations1 = data['data'];
            var member_html = ''
            var members = data['member'];
            if (data['status']) {
                weatherForecast(data.data[0].city);
                $(".detail_contact").html("");
                var tour = $("#tours").val();
                $(".tour_id_des").val(tour);
                $(".tour_id_detail").val(tour);

                if (data['checking'] == true) {
                    $("#delete_tour_d").css("display", "inline");
                    $("#edit_tour_e").css("display", "inline");
                } else {
                    $("#delete_tour_d").css("display", "none");
                    $("#edit_tour_e").css("display", "none");
                }
                var val;
                member_html += '<ul>';
                contact_detail = '';
                for (val in members) {
                    if (members[val]['own'] == 1) {
                        member_html += '<li>' + members[val]['firstname'] + ' ' + members[val]['lastname'] + ' (own)</li>';
                        contact_detail += '<div><span>Fullname: </span>' + members[val]['firstname'] + ' ' + members[val]['lastname'] + '</div>';
                        contact_detail += '<div><span>Email: </span>' + members[val]['email'] + '</div>';
                        contact_detail += '<div><span>Phone: </span>' + members[val]['phone'] + '</div>';
                        contact_detail += '<div><span>Address: </span>' + members[val]['address'] + '</div>';
                    } else {
                        member_html += '<li>' + members[val]['firstname'] + ' ' + members[val]['lastname'] + '</li>';

                    }
                }
                member_html += '</ul>';

                $(".showlisr_member").html(member_html);

                $(".detail_contact").html(contact_detail);

                tour_text = $("#tours option:selected").text();
                $(".caculate_tour .expensetoresearch .expensetoresearch1").html("Expense to reach " + tour_text + " ");
                $(".caculate_tour .expensetoresearch .expensetoresearch2").html(data['caculate']['expenses_tour_travel']);
                $(".caculate_tour .expense .expense1").html("SDfsd");
                $(".caculate_tour .expense .expense1").html("Expense at " + tour_text + " ");
                $(".caculate_tour .expense .expense2").html(data['caculate']['expenses_tour_des']);
                $(".caculate_tour .revenue .revenue1").html("Revenue at " + tour_text + " ");
                $(".caculate_tour .revenue .revenue2").html(data['caculate']['income_tour']);
                $(".caculate_tour .result_caculate .result_caculate1").html("Result at " + tour_text + " ");
                $(".caculate_tour .result_caculate .result_caculate2").html(data['caculate']['esult_ca']);
                $(".caculate_tour .result_caculate").addClass(data['caculate']['color']);

                if (data['tour_data']['des']) {
                    $(".show_des").html(data['tour_data']['des']);
                    CKEDITOR.instances['event_desc_tour'].setData(data['tour_data']['des']);
                    $(".tour_des").val("Edit");
                    $(".tour_des").html("Edit");
                } else {
                    $(".show_des").html('');
                    $(".tour_des").val("Add");
                    $(".tour_des").html("Add");
                }
                var detail_tours = data['detail_tours'];

                var val;

                $(".show_hotels").html("");
                $(".delete_detail").remove();
                $(".show_transport").html("");
                $(".show_flight").html("");

                $(".tour_tour_hotels").attr('onclick', "add_detail_tour($(this),0,'Add','hotels')");
                $(".tour_tour_hotels").val("Add");
                $(".tour_tour_hotels").html("Add");
                $(".tour_tour_transport").attr('onclick', "add_detail_tour($(this),0,'Add','transport')");
                $(".tour_tour_transport").val("Add");
                $(".tour_tour_transport").html("Add");
                $(".tour_tour_flight").attr('onclick', "add_detail_tour($(this),0,'Add','flight')");
                $(".tour_tour_flight").val("Add");
                $(".tour_tour_flight").html("Add");


                for (val in detail_tours) {
                    if (detail_tours[val]['type']) {
                        var type_value = detail_tours[val]['type'];

                        $(".tour_tour_" + type_value).parent().find(".show_" + detail_tours[val]['type']).html("");
                        $(".tour_tour_" + type_value).parent().find(".delete_detail").remove();


                        $(".tour_tour_" + type_value).attr('onclick', "add_detail_tour($(this)," + detail_tours[val]['id'] + ",'Edit','" + detail_tours[val]['type'] + "')");
                        $(".tour_tour_" + type_value).val("Edit");
                        $(".tour_tour_" + type_value).html("Edit");

                        var html_delete = '<input type="button" class="btn btn-delete excel-go delete_detail" onclick="delete_detail($(this),' + detail_tours[val]['id'] + ',\'' + type_value + '\')" value="Delete" />';

                        $(".tour_tour_" + type_value).parent().append(html_delete);


                        var html = "";
                        html += '<p>' + detail_tours[val]['room'] + '</p>';
                        html += '<div><b>' + detail_tours[val]['detail'] + '</b></div>';
                        html += '<div>' + detail_tours[val]['address'] + '</div>';
                        html += '<div>' + detail_tours[val]['phone'] + '</div>';
                        html += '<div style="color: green;">' + detail_tours[val]['website'] + '</div>';
                        html += '<hr />';
                        $(".show_" + detail_tours[val]['type']).html(html);
                        //}else{
                        // member_html += '<li>'+members[val]['firstname']+' '+ members[val]['lastname']+'</li>';

                    }
                }

                var event = '';
                var val;
                var events = data['events'];

                event += "<tr><th>Image</th><th>Title</th><th>Create by</th><th>Start date - End date</th></tr>";
                for (val in events) {
                    event += "<tr>";
                    if (events[val]['event_banner'] == "") {
                        event += "<td><a href='" + events[val]['url_link'] + "'><img width='50px' src='" + base_url + "assets/images/icon/manager_git_event.png' /></a></td>";
                    } else {
                        event += "<td><a href='" + events[val]['url_link'] + "'><img width='50px' src='" + base_url + "uploads/" + events[val]['user_id'] + "/photo/banner_events/" + events[val]['event_banner'] + "' /></a></td>";
                    }

                    event += "<td><a href='" + events[val]['url_link'] + "'>" + events[val]['event_title'] + "</a></td>";
                    event += "<td>" + events[val]['firstname'] + " " + events[val]['lastname'] + "</td>";
                    event += "<td>" + events[val]['event_start_date'] + " - " + events[val]['event_end_date'] + "</td>";
                    event += "</tr>";
                }

                $(".table_events").html(event);

                var schedules = data['schedules'];
                var daily_schedules = "";
                console.log(schedules);
                daily_schedules += "<tr><th>Title</th><th>Start time</th><th>End time</th></tr>";
                for (val in schedules) {
                    console.log("time: " + schedules[val]['start_time']);
                    daily_schedules += '<tr style="color:' + schedules[val]['color'] + ';">';
                    daily_schedules += "<td>" + schedules[val]['des'] + "</td>";
                    daily_schedules += "<td>" + schedules[val]['start_time'] + "</td>";
                    daily_schedules += "<td>" + schedules[val]['end_time'] + "</td>";
                    daily_schedules += "</tr>";
                }

                $(".daily_schedules").html(daily_schedules);

                var val;
                for (val in locations1) {
                    tmp += '<option value="' + locations1[val]['location_id'] + '">' + locations1[val]['location'] + '</option>';
                }

                /* address of locations */
                address += '<h4>' + (locations1[0]['address'] || '') + '</h4>';
                address += (locations1[0]['city'] || '') + ' ';
                address += (locations1[0]['state'] || '');
                address += '<br>' + (locations1['country'] || '');
                /* travel expense or Expense to reach destination */
                if (locations1[0]['reach_expense']) {
                    var reach_expenses = locations1[0]['reach_expense'];
                    for (reach_expense in reach_expenses) {
                        reach_htm += '<tr>';
                        reach_htm += '<td><button class="btn btn-xs btn-danger" onclick="delete_expense(' + reach_expenses[reach_expense]['id'] + ',\'' + reach_expenses[reach_expense]['expense_name'] + '\',' + locations1[0]['location_id'] + ')" >Delete</button></td>';

                        reach_htm += '<td><button class="btn btn-xs btn-default-custom btn-left" onclick="appear_expense_modal(\'edit\',\'save_expense()\',\'travel\',' + reach_expenses[reach_expense]['id'] + ',\'' + reach_expenses[reach_expense]['expense_name'] + '\',' + reach_expenses[reach_expense]['expense_price'] + ')">Edit</button></td>';
                        reach_htm += '<td>' + reach_expenses[reach_expense]['expense_name'] + ':</td>';
                        reach_htm += '<td><input type="text" disabled name="expense1" value="' + reach_expenses[reach_expense]['expense_price'] + '" class=""></td>';
                        reach_htm += '</tr>';

                        reach_expenses_total += +reach_expenses[reach_expense]['expense_price'];

                    }
                }
                /* destination_expense  */
                if (locations1[0]['destination_expense']) {
                    var des_expenses = locations1[0]['destination_expense'];
                    for (des_expense in des_expenses) {
                        des_htm += '<tr>';
                        des_htm += '<td><button class="btn btn-xs btn-danger" onclick="delete_expense(' + des_expenses[des_expense]['id'] + ',\'' + des_expenses[des_expense]['expense_name'] + '\',' + locations1[0]['location_id'] + ')">Delete</button></td>';
                        des_htm += '<td><button class="btn btn-xs btn-default-custom btn-left" onclick="appear_expense_modal(\'edit\',\'save_expense()\',\'at destination\',' + des_expenses[des_expense]['id'] + ',\'' + des_expenses[des_expense]['expense_name'] + '\',' + des_expenses[des_expense]['expense_price'] + ')" >Edit</button></td>';
                        des_htm += '<td>' + des_expenses[des_expense]['expense_name'] + ':</td>';
                        des_htm += '<td><input type="text" disabled name="expense1" value="' + des_expenses[des_expense]['expense_price'] + '" class=""></td>';
                        des_htm += '</tr>';

                        des_expenses_total += +des_expenses[des_expense]['expense_price'];

                    }

                }

                /* income  */
                if (locations1[0]['income']) {
                    var incomes = locations1[0]['income'];
                    for (income in incomes) {
                        income_htm += '<tr>';
                        income_htm += '<td><button class="btn btn-xs btn-danger" onclick="delete_income(' + incomes[income]['income_id'] + ',\'' + incomes[income]['income_name'] + '\',' + locations1[0]['location_id'] + ')" >Delete</button></td>';

                        income_htm += '<td><button class="btn btn-xs btn-default-custom btn-left" onclick="appear_income_modal(\'edit\',\'save_income()\',\'' + incomes[income]['income_id'] + '\',\'' + incomes[income]['income_name'] + '\',\'' + incomes[income]['income_price'] + '\')" >Edit</button></td>';
                        income_htm += '<td>' + incomes[income]['income_name'] + ':</td>';
                        income_htm += '<td><input type="text" disabled name="expense1" value="' + incomes[income]['income_price'] + '" class=""></td>';
                        income_htm += '</tr>';

                        income_total += +incomes[income]['income_price'];

                    }

                }

            } else {
                tmp += '<option value="">No Record Found!!!</option>';
            }
            if (!$.isEmptyObject(locations1)) {
                $('#reach_label').html('Expense to reach ' + locations1[0]['location']);
                $('#destination_label').html('Expense at ' + locations1[0]['location']);
                $('#income_label').html('Revenue ' + locations1[0]['location']);
            } else {
                $('#reach_label').html('Expense to reach ');
                $('#destination_label').html('Expense at ');
                $('#income_label').html('Revenue ');
            }

            $('#address').html(address);
            $('#location_all').html(tmp);
            /*reach*/
            reach_htm += '<tr><td colspan=2></td>';
            reach_htm += '<td >Total:</td>';
            reach_htm += '<td ><input type="text" disabled value="' + reach_expenses_total + '" class=""></td>';
            reach_htm += '</tr>';
            $('#expense_to_reach').html(reach_htm);
            /*destination*/
            des_htm += '<tr><td colspan=2></td>';
            des_htm += '<td>Total:</td>';
            des_htm += '<td><input type="text" disabled value="' + des_expenses_total + '" class=""></td>';
            des_htm += '</tr>';
            $('#expense_at_destination').html(des_htm);

            /*income*/
            income_htm += '<tr><td colspan=2></td>';
            income_htm += '<td>Total:</td>';
            income_htm += '<td><input type="text" disabled value="' + income_total + '" class=""></td>';
            income_htm += '</tr>';
            $('#income').html(income_htm);
        },
        complete: function() {
            $(".detail_contact").html("");
            var tour = $("#tours").val();
            $(".tour_id_des").val(tour);
            $(".tour_id_detail").val(tour);

            mj_get_tour_location(); // mj_function
            setTimeout(function() { create_map(); }, 300);
        }
    });
}

function get_location_update(tour_id) {
    console.log(tour_id);
    $.ajax({
        url: base_url + 'the_total_tour/get_tour_chain_data',
        data: {
            tour_id: tour_id,
            'csrf_test_name': get_csrf_hash
        },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var tmp = '';
            var address = '';
            var reach_expenses_total = 0;
            var reach_htm = '';

            var des_expenses_total = 0;
            var des_htm = '';

            var income_total = 0;
            var income_htm = '';
            var locations1 = data['data'];
            if (data['status']) {

                var val;
                for (val in locations1) {

                    tmp += '<option value="' + locations1[val]['location_id'] + '">' + locations1[val]['location'] + '</option>';
                }

                /* address of locations */
                address += '<h4>' + (locations1[0]['address'] || '') + '</h4>';
                address += (locations1[0]['city'] || '') + ' ';
                address += (locations1[0]['state'] || '');
                address += '<br>' + (locations1['country'] || '');
                /* travel expense or Expense to reach destination */
                if (locations1[0]['reach_expense']) {
                    var reach_expenses = locations1[0]['reach_expense'];
                    for (reach_expense in reach_expenses) {
                        reach_htm += '<tr>';
                        reach_htm += '<td><button class="btn btn-xs btn-danger" onclick="delete_expense(' + reach_expenses[reach_expense]['id'] + ',\'' + reach_expenses[reach_expense]['expense_name'] + '\',' + locations1[0]['location_id'] + ')" >Delete</button></td>';

                        reach_htm += '<td><button class="btn btn-xs btn-default-custom btn-left" onclick="appear_expense_modal(\'edit\',\'save_expense()\',\'travel\',' + reach_expenses[reach_expense]['id'] + ',\'' + reach_expenses[reach_expense]['expense_name'] + '\',' + reach_expenses[reach_expense]['expense_price'] + ')">Edit</button></td>';
                        reach_htm += '<td>' + reach_expenses[reach_expense]['expense_name'] + ':</td>';
                        reach_htm += '<td><input type="text" disabled name="expense1" value="' + reach_expenses[reach_expense]['expense_price'] + '" class=""></td>';
                        reach_htm += '</tr>';

                        reach_expenses_total += +reach_expenses[reach_expense]['expense_price'];

                    }
                }
                /* destination_expense  */
                if (locations1[0]['destination_expense']) {
                    var des_expenses = locations1[0]['destination_expense'];
                    for (des_expense in des_expenses) {
                        des_htm += '<tr>';
                        des_htm += '<td><button class="btn btn-xs btn-danger" onclick="delete_expense(' + des_expenses[des_expense]['id'] + ',\'' + des_expenses[des_expense]['expense_name'] + '\',' + locations1[0]['location_id'] + ')">Delete</button></td>';
                        des_htm += '<td><button class="btn btn-xs btn-default-custom btn-left" onclick="appear_expense_modal(\'edit\',\'save_expense()\',\'at destination\',' + des_expenses[des_expense]['id'] + ',\'' + des_expenses[des_expense]['expense_name'] + '\',' + des_expenses[des_expense]['expense_price'] + ')" >Edit</button></td>';
                        des_htm += '<td>' + des_expenses[des_expense]['expense_name'] + ':</td>';
                        des_htm += '<td><input type="text" disabled name="expense1" value="' + des_expenses[des_expense]['expense_price'] + '" class=""></td>';
                        des_htm += '</tr>';

                        des_expenses_total += +des_expenses[des_expense]['expense_price'];

                    }

                }

                /* income  */
                if (locations1[0]['income']) {
                    var incomes = locations1[0]['income'];
                    for (income in incomes) {
                        income_htm += '<tr>';
                        income_htm += '<td><button class="btn btn-xs btn-danger" onclick="delete_income(' + incomes[income]['income_id'] + ',\'' + incomes[income]['income_name'] + '\',' + locations1[0]['location_id'] + ')" >Delete</button></td>';

                        income_htm += '<td><button class="btn btn-xs btn-default-custom btn-left" onclick="appear_income_modal(\'edit\',\'save_income()\',\'' + incomes[income]['income_id'] + '\',\'' + incomes[income]['income_name'] + '\',\'' + incomes[income]['income_price'] + '\')" >Edit</button></td>';
                        income_htm += '<td>' + incomes[income]['income_name'] + ':</td>';
                        income_htm += '<td><input type="text" disabled name="expense1" value="' + incomes[income]['income_price'] + '" class=""></td>';
                        income_htm += '</tr>';
                        income_total += +incomes[income]['income_price'];
                    }
                }

            } else {
                tmp += '<option value="">No Record Found!!!</option>';
            }
            if (!$.isEmptyObject(locations1)) {
                $('#reach_label').html('Expense to reach ' + locations1[0]['location']);
                $('#destination_label').html('Expense at ' + locations1[0]['location']);
                $('#income_label').html('Revenue ' + locations1[0]['location']);
            } else {
                $('#reach_label').html('Expense to reach ');
                $('#destination_label').html('Expense at ');
                $('#income_label').html('Revenue ');
            }

            $('#address').html(address);
            $('#location_all').html(tmp);
            /*reach*/
            reach_htm += '<tr><td colspan=2></td>';
            reach_htm += '<td >Total:</td>';
            reach_htm += '<td ><input type="text" disabled value="' + reach_expenses_total + '" class=""></td>';
            reach_htm += '</tr>';
            $('#expense_to_reach').html(reach_htm);
            /*destination*/
            des_htm += '<tr><td colspan=2></td>';
            des_htm += '<td>Total:</td>';
            des_htm += '<td><input type="text" disabled value="' + des_expenses_total + '" class=""></td>';
            des_htm += '</tr>';
            $('#expense_at_destination').html(des_htm);

            /*income*/
            income_htm += '<tr><td colspan=2></td>';
            income_htm += '<td>Total:</td>';
            income_htm += '<td><input type="text" disabled value="' + income_total + '" class=""></td>';
            income_htm += '</tr>';
            $('#income').html(income_htm);
        },
        complete: function() {

            setTimeout(function() { create_map_update(); }, 100);


        }
    });
}
get_location($('#tours').val());

function mj_scal(tour_id, location_id) {
    $.ajax({
        url: base_url + 'the_total_tour/mj_schedules/' + tour_id + '/' + location_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var location_id = data['location_id'];
            var tour_id = data['tour_id'];
            var tour = data['tour'];
            var schedules = data['schedules'];
            var check_member = data['check_member'];
            var user_data = data['user_data'];
            var locations = data['locations'];
            var eventsSch = [];
            if (schedules.length != 0) {
                for (schedule in schedules) {
                    eventsSch.push({
                        //{
                        title: schedules[schedule]['des'],
                        start: schedules[schedule]['start_time'],
                        end: schedules[schedule]['end_time'],
                        color: schedules[schedule]['color']

                        /*if(check_member){
                            // url:'javascript:create_event(\'edit\',\'+' $schedule['start_time']\',\'+$schedule['end_time']); ?>\',<?php echo $schedule['id']; ?>)',<?php 
                  
                            color: schedules[schedule]['des'],
                            }*/
                        //}
                    });
                }
            } else {
                eventsSch = [];
            }
            console.log("----ev-----");
            console.log(eventsSch);
            var default_date = new Date().toJSON().slice(0, 10);
            /*----------------- tour ----------------*/
            if (tour) {
                //console.log(tour);
                //var tour_tour = tour['tour'];
                // var tour_tour_id = tour['tour_id'];

            }

            /* fullcalender start*/
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('addEventSource', eventsSch);
            $('#calendar').fullCalendar('rerenderEvents');
            $('#calendar').fullCalendar({
                //console.log(schedules);                
                theme: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaDay'
                },
                defaultView: 'agendaDay',
                timeFormat: {
                    agenda: 'HH(:mm)' //h:mm{ - h:mm}'
                },
                //timeFormat: 'H(:mm)', // uppercase H for 24-hour clock
                defaultDate: default_date,
                selectable: true,
                displayEventTime: true,
                selectHelper: true,
                slotLabelFormat: "HH:mm",
                select: function(start, end) {
                    // var title = prompt('Event Title:');
                    console.log(schedules);
                    if (check_member['manager_schedule']) {
                        var title = create_event('new', start, end);
                    } else { ''; }

                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                editable: false,
                eventLimit: true, // allow "more" link when too many events

                events: eventsSch
            }); /* End calender */
        } /* End Sucess */
    }); /* End ajax function */
} /* End main function */



function mj_get_tour_location() {
    var tour = $('#tours').val();
    var location = $('#location_all').val();

    if (tour && location) {
        mj_scal(tour, location);
    } else {
        //alert('good bye');
    }

};

function weatherForecast(location) {
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
            $('.weatherSpan').html(location + " : Weather Forecast");
            $('.weatherCls').html(weatherData);

        }
    });
}

function checkNoTour() {
    intervalId = setInterval(function() {
        if ($("#tours").val() == "") {
            console.log("here");
            $('.errorDiv').html("You have not added any tour yet").fadeIn("3000");
            $('.tourAddDiv').addClass('bgClr');
        } else {
            $('.errorDiv').hide();
            $('.tourAddDiv').removeClass('bgClr');
            window.clearInterval(intervalId);
        }
    }, 6000);
}

function get_manager_member_view(tour_id) {
    $.ajax({
        url: base_url + 'member/index' + tour_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
        }
    });
}

$(document).on('change', '.selectschedulelocation', function()
{
    location_id = $(this).val();
    get_daily_schedules_view_tour_location(tour_id, location_id);
});

$(document).on('change', '.selectshowlocations', function()
{
    location_id = $(this).val();
    get_book_show_tour_view_location(tour_id, location_id);
});

