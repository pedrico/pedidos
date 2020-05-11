<!DOCTYPE html>
<html>

<head>
    <title>Simple Click Events</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <script src="{{ asset('inspinia/js/jquery-3.1.1.min.js') }}" ></script>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <input type="hidden" name="pedricolat" id="pedricolat" value="{{$lat}}">
    <input type="hidden" name="pedricolong" id="pedricolong" value="{{$long}}">
    <script>
        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        var map;
        var markers = [];

        function initMap() {
            var pedricolat = parseFloat(document.getElementById('pedricolat').value);
            var pedricolong = parseFloat(document.getElementById('pedricolong').value);
            console.log(pedricolat, pedricolong);
            var myLatlng = {
                lat: pedricolat,
                lng: pedricolong
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: myLatlng
            });

            addMarker(myLatlng);
            // var marker = new google.maps.Marker({
            //     position: myLatlng,
            //     map: map,
            //     title: 'Click to zoom'
            // });

            // map.addListener('center_changed', function() {
            //     // 3 seconds after the center of the map has changed, pan back to the
            //     // marker.
            //     window.setTimeout(function() {
            //         map.panTo(marker.getPosition());
            //     }, 3000);
            // });

            // marker.addListener('click', function() {
            //   map.setZoom(16);
            //   map.setCenter(marker.getPosition());
            // });

            // This event listener will call addMarker() when the map is clicked.
            map.addListener('click', function(event) {
                clearMarkers();
                markers = [];
                // console.log(event.latLng.lng());
                console.log(event.latLng.lat());
                console.log('Seteando');
                $('#lat', parent.document).val(event.latLng.lat());
                $('#lng', parent.document).val(event.latLng.lng());
                addMarker(event.latLng);
            });


            // Adds a marker to the map and push to the array.
            function addMarker(location) {
                // console.log("agregando marker");
                // console.log(location.lng());
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
                markers.push(marker);
            }

            // Sets the map on all markers in the array.
            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            // Removes the markers from the map, but keeps them in the array.
            function clearMarkers() {
                setMapOnAll(null);
            }


        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPe7oyFNBHi-COJVUGMswrbwJVgHaKJ9o&callback=initMap">
    </script>
</body>

</html>