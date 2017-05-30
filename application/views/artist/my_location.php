
    <div id="map"></div>
    <script src="http://www.google.com/jsapi?key=AIzaSyBJvpLZ60bn_tarrmdSp10I9wjuoJKjT70"></script>
<script>
	(function () {
		google.load("maps", "2");
		google.setOnLoadCallback(function () {
			// Create map
			var map = new google.maps.Map2(document.getElementById("map")),
				markerText = "<h2>You are here</h2><p>Nice with geolocation, ain't it?</p>",
				markOutLocation = function (lat, long) {
					var latLong = new google.maps.LatLng(lat, long),
						marker = new google.maps.Marker(latLong);
					map.setCenter(latLong, 13);
					map.addOverlay(marker);
					marker.openInfoWindow(markerText);
					google.maps.Event.addListener(marker, "click", function () {
						marker.openInfoWindow(markerText);
					});
				};
				map.setUIToDefault();

			// Check for geolocation support	
			if (navigator.geolocation) {
				// Get current position
				navigator.geolocation.getCurrentPosition(function (position) {
						// Success!
						markOutLocation(position.coords.latitude, position.coords.longitude);
                        
                        //alert('<?php echo base_url('artist/showgigs');?>/'+ position.coords.latitude+"/" + position.coords.longitude);
                        
                        //window.location.href = document.location+"/" + position.coords.latitude+"/" + position.coords.longitude;
                        window.location.href = '<?php echo base_url('artist/showgigs');?>/'+ position.coords.latitude+"/" + position.coords.longitude;
                        
                        
					}, 
					function () {
						// Gelocation fallback: Defaults to Stockholm, Sweden
                        markOutLocation(position.coords.latitude, position.coords.longitude);
                        alert('bbb');
						//markerText = "<p>Please accept geolocation for me to be able to find you. <br>I've put you in Stockholm for now.</p>";
						//markOutLocation(59.3325215, 18.0643818);
                        window.location.href = '<?php echo base_url('artist/showgigs');?>/'+ position.coords.latitude+"/" + position.coords.longitude;
					}
				);
			}
			else {
				window.location.href = '<?php echo base_url('artist/showgigs');?>';
                // No geolocation fallback: Defaults to Eeaster Island, Chile
				markerText = "<p>No location support. Try Easter Island for now. :-)</p>";
				markOutLocation(-27.121192, -109.366424);
			}
		});	
	})();
</script>

