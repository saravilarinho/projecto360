<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="interacoes.js"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Info Windows</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #content {
            padding-top: 0px;
            padding-left: 0px;
        }


    </style>
</head>
<body>
<div id="map"></div>
<script>

    // This example displays a marker at the center of Australia.
    // When the user clicks the marker, an info window opens.

    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });

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

        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            title: 'EVENTINHO'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiqx4hBCg47FnZfxDoCHJMK6a1hPuPfGo&callback=initMap">
</script>
</body>
</html>

