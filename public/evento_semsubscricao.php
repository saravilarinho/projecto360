<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])) {
    $id_utilizador = $_SESSION['id_utilizador'] ;
    $id_evento = $_GET['id'];
}
?>


<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- INTEGRAÇÃO BOOTSTRAP VIA CDN ##############################################################################-->
    <!-- JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY  JQUERY -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <!-- POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER POPPER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
    <!-- BOOTSTRAP CSS  BOOTSTRAP CSS  BOOTSTRAP CSS  BOOTSTRAP CSS  BOOTSTRAP CSS  BOOTSTRAP CSS  BOOTSTRAP CSS  -->
    <link rel="stylesheet" href="css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- BOOTSTRAP JS BOOTSTRAP JS BOOTSTRAP JS BOOTSTRAP JS BOOTSTRAP JS BOOTSTRAP JS BOOTSTRAP JS BOOTSTRAP JS -->
    <script src="js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>
    <!-- INTEGRAÇÃO BOOTSTRAP VIA CDN ##############################################################################-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <script src="interacoes.js" ></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Evento</title>
</head>

<body>

<main>
<?php


require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT nome_evento, data_inicio_evento, data_fim_evento, localizacao_evento, descricao_evento,
categorias_id_categoria, niveis_privacidade_id_nivel_privacidade, imagem_evento, coor_lat, coor_long
                  FROM eventos
                  WHERE id_evento = ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $id_evento);

    $id_evento = $_GET['id'];

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome, $data_inicio, $data_fim, $localizacao, $descricao, $categoria, $privacidade, $imagem, $lat, $long);


    if (mysqli_stmt_fetch($stmt)) {

        ?>

        <img class="w-100" src="imagens/evento2.jpeg">
    <div class="pl-4 container superior_redondo">
        <div class="info_evento">
            <p class="titulo_evento mb-3 mt-4"> <?= $nome?></p>
            <div class="row alinhamento_icones">
                <i class="col-1 fas fa-map-marker-alt"></i>
                <p class="col-11 texto_descricao_evento"><?= $localizacao?></p></div>
            <div class="row alinhamento_icones">
                <i class="col-1 far fa-calendar-alt"></i>
                <p class="col-11 texto_descricao_evento"><?= $data_inicio?> - <?= $data_fim?></p>
            </div>
            <div class="row mb-0 alinhamento_icones" >
                <p class="col-7 texto_descricao_evento">+ 47 participantes</p>
                <p class="col-5 texto_descricao_evento">
                    <img class="icone_categoria" src="imagens/icones/icone_festa.png"> Música </p>
            </div>
        </div>

        <p class="titulo_evento mb-1"><b>Descrição</b></p>
        <p class="texto_descricao_evento"><?= $descricao?></p>

        <p class="titulo_evento mb-2 mt-3"><b>Últimas 24 horas</b></p>

        <div class="container">
            <div class="row info_evento">
                <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                <p class="texto_descricao_evento col-10">4 novos subscritores</p>
            </div>
            <div class="row info_evento">
                <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                <p class="texto_descricao_evento col-10">32 novos conteúdos</p>
            </div>
            <div class="row info_evento">
                <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                <p class="texto_descricao_evento col-10">2 novas relações entre conteúdos</p>
            </div>

        </div>


        <?php

    }
    }

?>

        <div class="justify-content-center d-flex mt-2">


            <button class="btn botao_grande" >
                <a href="scripts/suscrever_evento.php?id=<?=$id_evento?>" class="linkar_branco">
                Subscrever
                </a>
            </button>

        </div>





    </div>

</main>

</body>
</html>