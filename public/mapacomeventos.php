<?php

if (isset($_SESSION['id_utilizador'])) {
    $id_utilizador = $_SESSION['id_utilizador'] ;

}
?>

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

    <link rel="stylesheet" type="text/css" href="estilos.css">

</head>
<body>
<!--The div element for the map -->
<div id="map"></div>

<?php

require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT id_evento, nome_evento, data_inicio_evento, localizacao_evento, imagem_evento, coor_lat, coor_long 
          FROM `eventos` ";


if (mysqli_stmt_prepare($stmt, $query)) {

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $nome, $data_inicio, $localizacao, $imagem, $latitude, $longitude);

?>


<script type="text/javascript">

    // Initialize and add the map
    var map, infoWindow;
    function initMap() {

        // The map, centered at localizacao
        var map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: localizacao});
        infoWindow = new google.maps.InfoWindow;

        <?php
        $i = 0;
        while (mysqli_stmt_fetch($stmt)) {
        ?>

        // localizacao dos markers
        var localizacao = {lat: <?= $latitude ?>, lng: <?= $longitude ?>};

        // cria os markers, e infowindows positioned at localizacao
        var infowindow<?=$i?> = new google.maps.InfoWindow({
            content: '<div class="ok">' + '<div  class="p-fixed">' +
                '<a class="linkar" href="scripts/verifica_evento.php?id=<?=$id?>">' +
                '<img src="imagens/evento1.jpeg" class="card-img-top w-100" alt="...">' +
                '<div style="padding: 3% 5% 5%">' +
                '<div class="row">' +
                '<p class=" mb-1 titulo_card_eventos col-10"><b><?=$nome ?> </b></p> ' +
                '<img class="icone_categoria" src="imagens/icones/icone_festa.png"></div> ' +
                '<p class=" texto_card_eventos m-0">' +
                '<small> <?=$data_inicio?> </small> </p>' +
                '<p class=" texto_card_eventos m-0"> <small> <?=$localizacao?> </small>' +
                '</p> </div>  </a> </div>' + '</div>' + '</div>',
            maxWidth: 250
        });

        var marker<?=$i?> = new google.maps.Marker({position: localizacao, map: map});
        //funcao que fica a ouvir por cliques nos cards
        marker<?=$i?>.addListener('click', function() {
            infowindow<?=$i?>.open(map, marker<?=$i?>);
        });

        <?php

        $i++;

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
                infoWindow.setContent('<h3 style="color: #1ec5bc">Estás aqui</h3>');
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



<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANHSkUQUDM1qLwsjBfR55m3Ua0Pvbj2ic&callback=initMap">
</script>
</body>
</html>

