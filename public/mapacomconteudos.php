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
            width: 97%;
            height: 65vh;
            background-color: grey;
        }
        #naohamapa{
            width: 97%;
            height: 20vh;
            text-align: center;
            margin-top: 35%;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="estilos.css">

</head>
<body>
<!--The div element for the map -->
<div id="map"></div>
<div id="naohamapa" ></div>

<?php

require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT publicacoes.id_publicacao, publicacoes.conteudo_publicacao, publicacoes.coor_lat, publicacoes.coor_lng, eventos.coor_lat, eventos.coor_long 
FROM publicacoes 
INNER JOIN utilizadores_has_publicacoes 
ON utilizadores_has_publicacoes.publicacoes_id_publicacao = publicacoes.id_publicacao 
INNER JOIN eventos 
ON eventos.id_evento = publicacoes.eventos_id_evento 
WHERE publicacoes.eventos_id_evento = ?
";


if (mysqli_stmt_prepare($stmt, $query)) {

mysqli_stmt_bind_param($stmt, 'i', $id);
$id = $_GET['id'];

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id_pub, $conteudo, $lat_pub, $long_pub, $evento_lat, $evento_long);

?>


<script type="text/javascript">

    // Initialize and add the map
    var map, infoWindow;
    function initMap() {

        // The map, centered at localizacao
        infoWindow = new google.maps.InfoWindow;

        <?php


        if (is_null(mysqli_stmt_fetch($stmt))){
        ?>
        console.log("wut");

        document.getElementById("naohamapa").innerHTML = "Este evento ainda não possui conteúdos localizados geograficamente.";
        document.getElementById("map").style.display ="none";

        <?php }

        else {

            if (mysqli_stmt_fetch($stmt) != 0){


        $i = 0;
        while (mysqli_stmt_fetch($stmt)) {

        ?>
        // localizacao dos markers
        var localizacao = {lat: <?= $evento_lat ?>, lng: <?= $evento_long ?>};

        var map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: localizacao});


        map.setCenter(localizacao);

        // cria os markers, e infowindows positioned at localizacao
        var infowindow<?=$i?> = new google.maps.InfoWindow({
            content: '<div class="ok">' + '<div class="position-fixed" style:"max-width: 25vh; max-height: 18vh; border-radius: 10px;">' +
                '<a class="linkar" href="publicacao.php?idp=<?=$id_pub?>">' +
                '<img src="scripts/upload/<?=$conteudo?>" class="card-img-top w-100 h-100"; object-fit: contain" alt="...">' +
                '<div style="padding: 3% 5% 5%">' +
                '<div class="row">' +
                '<p class=" mb-1 titulo_card_eventos col-10"><b> </b></p> ' +
                '<p class=" texto_card_eventos m-0">' +

                '<p class=" texto_card_eventos m-0"> <small>  </small>' +
                '</p> </div>  </a> </div>' + '</div>' + '</div>',
            maxWidth: 250
        });


        var localizacao_pub = {lat: <?=$lat_pub?>, lng: <?=$long_pub?>};
        var marker<?=$i?> = new google.maps.Marker({position: localizacao_pub, map: map});
        //funcao que fica a ouvir por cliques nos cards
        marker<?=$i?>.addListener('click', function () {
            infowindow<?=$i?>.open(map, marker<?=$i?>);
        });


        <?php

        $i++;
        }

            } else{
        ?>
        console.log("wut");

        document.getElementById("naohamapa").innerHTML = "Este evento não possui conteúdos localizados geograficamente.";
        document.getElementById("map").style.display ="none";

        <?php
    }

        }




}

        ?>


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

