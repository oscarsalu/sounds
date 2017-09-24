     function sent_mail_epk_tour() {
         //alert('sentmail');
         var end = $("#end").val();
         var start = $("#start").val();
         $.ajax({
             url: $url + "the_total_tour/roadtour/sent_mail",
             type: "post",
             data: {
                 "tour": tour,
                 "start": start,
                 "end": end,
                 "csrf_test_name": $records_per_page
             },
             dataType: "json",
             success: function(data) {
                 $.each(data, function(key, value) {
                     //alert( key + ": " + value['email_to'] );
                     if (value['msg_sent'] == true) {
                         alert('Email to: ' + value['email_to'] + 'is sended');
                     } else {
                         alert('Email to: ' + value['email_to'] + ' can not send');
                     }
                 });

             }

         });
         $("#modal_sent_roadmap").hide();
         $(".modal-backdrop").hide();
     }

     function initMap() {
         console.log("init map");
         var directionsDisplay = new google.maps.DirectionsRenderer;
         var directionsService = new google.maps.DirectionsService;
         var map = new google.maps.Map(document.getElementById('maproadtour'), {
             zoom: 7,
             center: { lat: 41.85, lng: -87.65 }
         });
         console.log(map);
         directionsDisplay.setMap(map);
         directionsDisplay.setPanel(document.getElementById('right-panel'));

         /*var control = document.getElementById('floating');
         control.style.display = 'block';
         map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);*/

         var onChangeHandler = function() {

             calculateAndDisplayRoute(directionsService, directionsDisplay);

         };
         document.getElementById('submit_itinerary').addEventListener('click', onChangeHandler);

     }

     function calculateAndDisplayRoute(directionsService, directionsDisplay) {
         var start = document.getElementById('start_point').value;
         var end = document.getElementById('end_point').value;

         var waypts = [];
         var checkboxArray = document.getElementById('waypoints');
         for (var i = 0; i < checkboxArray.length; i++) {
             if (checkboxArray.options[i].selected) {
                 waypts.push({
                     location: checkboxArray[i].value,
                     stopover: true
                 });
             }
         }

         directionsService.route({
             origin: start,
             destination: end,
             waypoints: waypts,
             optimizeWaypoints: true,
             travelMode: 'DRIVING'
         }, function(response, status) {
             if (status === 'OK') {
                 directionsDisplay.setDirections(response);
                 var x = document.getElementById("right-panel");
                 x.style.background = "#f1efef";
                 var html = '';
                 html += '<button type="button" data-toggle="modal"  data-target="#modal_sent_roadmap" class="btn btn-info" style="margin:10px;float:right;">Sent Road Map</button>';
                 $("#right-panel").html(html);

             } else {
                 window.alert('Directions request failed due to ' + status);
             }
         });
     }


     function get_trip() {
         if ($('StartPoint').value == '') {
             alert('Please enter your starting address');
             return false;
         } else {
             url = 'https://www.google.com/maps/dir/760+West+Genesee+Street+Syracuse+NY+13204/314+Avery+Avenue+Syracuse+NY+13204'
                 // alert(url);
             window.open(url, 'tripwindow');
         }
     }

     function sent_mail_itinerary_tour() {
         alert('sentmail');
         return;
         var end = $("#end").val();
         var start = $("#start").val();
         $.ajax({
             url: $url + "the_total_tour/roadtour/sent_itinerary_mail",
             type: "post",
             data: {
                 "tour": tour,
                 "start": start,
                 "end": end,
                 "csrf_test_name": $records_per_page
             },
             dataType: "json",
             success: function(data) {
                 console.log(data);
                 $.each(data, function(key, value) {
                     //alert( key + ": " + value['email_to'] );
                     if (value['msg_sent'] == true) {
                         alert('Email to: ' + value['email_to'] + 'is sended');
                     } else {
                         alert('Email to: ' + value['email_to'] + ' can not send');
                     }
                 });

             }

         });
     }






     function save_itinerary1() {
         if ($("#email_id").val() != null) {
             var post_data = $("#form_itinerary_submit_data").serialize();
             $.ajax({
                 url: $url + "the_total_tour/roadtour/save_itinerary",
                 type: 'POST',
                 data: post_data,
                 dataType: 'json',
                 success: function(data) {
                     console.log(data);
                     if (data['status']) {
                         alertify.success(data['msg']);
                         for (var i = 0; i < data['mail_data'].length; i++) {
                             if (data['mail_data'][i]['msg_sent']) {
                                 alertify.success("Mail send at " + data['mail_data'][i]['email_to']);
                             } else {
                                 alertify.success("Not send at " + data['mail_data'][i]['email_to']);
                             }
                         }
                         $('#email_id').empty();
                     } else {
                         alertify.error(data['msg']);
                     }
                 }
             });
         } else {
             alertify.error('Please insert member email !');
         }
         return false;
     }
