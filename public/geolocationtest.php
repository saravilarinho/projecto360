<!--<!DOCTYPE html>

<script>
    var customLabel = {
        restaurant: {
            label: 'R'
        },
        bar: {
            label: 'B'
        }
    };

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(40.6300, 8.6571),
            zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
                var id = markerElem.getAttribute('id');
                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('address');
                var type = markerElem.getAttribute('type');
                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));

                var infowincontent = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = name
                infowincontent.appendChild(strong);
                infowincontent.appendChild(document.createElement('br'));

                var text = document.createElement('text');
                text.textContent = address
                infowincontent.appendChild(text);
                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    label: icon.label
                });
                marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });
            });
        });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiqx4hBCg47FnZfxDoCHJMK6a1hPuPfGo&callback=initMap"> </script>
</body>
</html>-->




<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        #map {
            width: 90%;
            height: 365px;
            background-color: grey;
        }
    </style>
</head>
<body>
<!--The div element for the map -->
<div id="map"></div>


<?php

require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT id_evento, nome_evento, data_inicio_evento, localizacao_evento, coor_lat, coor_long 
FROM `eventos` ";


if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nome, $data_inicio, $localizacao, $latitude, $longitude);

    ?>


<script>
    // Initialize and add the map
    var map, infoWindow;
    function initMap() {
        // The location
       // var localizacao = {lat: <?= $latitude ?>, lng: <?= $longitude ?>};
        // The map, centered at Uluru
        var map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: localizacao});
        infoWindow = new google.maps.InfoWindow;


        <?php
        while (mysqli_stmt_fetch($stmt)) {
?>
        // The location
        var localizacao = {lat: <?= $latitude ?>, lng: <?= $longitude ?>};
        // The markers, positioned at localizacao


        var contentString = '<div  class=" h-100">'+
            '<a class="linkar" href="eventocomsubscricao.html">'+
            '<img src="imagens/evento1.jpeg" class="card-img-top" alt="...">'+
            '<div style="padding: 8%">'+
            '<div class="row">'+
            '<p class=" mb-1 titulo_card_eventos col-10"><b> EVENTINHO </b></p> ' +
            '<img class="icone_categoria" src="imagens/icones/icone_festa.png">' +
            '</div> '+
            '<p class=" texto_card_eventos m-0">' +
            '<small> enfim ne </small>' +
            '</p>'+
            '<p class=" texto_card_eventos m-0"> <small> nao sei </small>' +
            '</p> </div>  </a> </div>';

        var infowindow = new google.maps.InfoWindow({
            content: '<div class="ok">' + contentString + '</div>',
            maxWidth: 250});


        // The markers, positioned at localizacao
        var marker = new google.maps.Marker({position: localizacao, map: map, title: 'Uluru (Ayers Rock)'});

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        <?php

        }

        }

        ?>



        // user location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };


                infoWindow.setPosition(pos);
                infoWindow.setContent('Estás aqui');
                infoWindow.open(map);
                map.setCenter(pos);

                var marker = new google.maps.Marker({position: pos, map: map});

            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser does not support geolocation.');
        infoWindow.open(map);
    }

</script>



<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiqx4hBCg47FnZfxDoCHJMK6a1hPuPfGo&callback=initMap">
</script>
</body>
</html>