

<!DOCTYPE html>
<html>
<head>
    <title>Place Autocomplete</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../estilos.css">

    <style>
        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }


    </style>
</head>
<body>
<div class="pac-card" id="pac-card">
    <div id="pac-container">
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        <input type="hidden" name="location" id="location">
        <input id="pac-input" type="text" class="form-control campos_form_criarevento" placeholder="Enter a location" value=" ">
    </div>
</div>
<div id="map" style="display: none"></div>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            var item_lat = place.geometry.location.lat();
            var item_lng = place.geometry.location.lng();



            document.getElementById("lat").value= item_lat;
            document.getElementById("lng").value= item_lng;


            console.log(document.getElementById("lat").value);
            console.log(document.getElementById("lng").value);
            console.log(document.getElementById("pac-input").value);

        });

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiqx4hBCg47FnZfxDoCHJMK6a1hPuPfGo&libraries=places&callback=initMap" async defer></script>

</body>
</html>


