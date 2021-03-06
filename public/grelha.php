<?php

session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_evento = $_GET['id'];

}
else{
    header("Location: login.php?message=2");

}

date_default_timezone_set('Europe/Lisbon');
$rn = date('h:i', time());




require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT nome_evento, data_inicio_evento, hora_inicio,  data_fim_evento, hora_fim, localizacao_evento, descricao_evento, 
categorias_id_categoria, imagem_evento, coor_lat, coor_long, utilizadores_has_eventos.favorito, utilizadores_has_eventos.roles_id_role
          FROM eventos
          INNER JOIN utilizadores_has_eventos
          ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento 
          WHERE eventos.id_evento = ? AND utilizadores_has_eventos.utilizadores_id_utilizador = ?";


if (mysqli_stmt_prepare($stmt, $query)) {
mysqli_stmt_bind_param($stmt, 'ii', $id, $id_user);

$id = $id_evento;
$id_user = $id_utilizador;
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nome_evento,  $data_inicio, $hora_inicio, $data_fim, $hora_fim, $localizacao, $descricao, $categoria, $imagem, $lat, $lng, $favorito, $id_role);

if (mysqli_stmt_fetch($stmt)) {

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GRElha</title>

</head>

<style>

    .imagem_grelha {
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

</style>

<body>

<main>

    <a href="eventos.php">
        <i class="fas fa-2x fa-chevron-circle-left voltar"></i></a>
    <?php
    if (isset($imagem)) {
        ?>
        <img class="w-100" src="scripts/upload/<?= $imagem ?>">
        <?php
    } else {
        ?>
        <img class="w-100" src="imagens/evento1.jpeg?>">
        <?php
    }
    ?>


    <div class="pl-4 container superior_redondo">

        <p class="titulo_evento mb-3 mt-3 col-10">
            <?= $nome_evento ?>
            <span class="alinhar_fav col-2">
            <a class="btn botao_favorito" href="scripts/favoritar_evento.php?id=<?= $id ?>">
                    <?php
                    if ($favorito === 0) {
                        ?>
                        <i class="far fa-star" style="font-size: 15px;"></i>
                        <?php
                    } else {
                        if ($favorito === 1) {
                            ?><i class="fas fa-star" style="font-size: 15px;"></i>
                            <?php
                        }

                    }

                    ?>
            </a>

                    <?php
                    if ($id_role === 1) {
                        ?>
                        <a class="btn botao_favorito" href="editar_evento.php?id=<?= $id ?>">
                        <i class="far fa-edit" style="font-size: 15px;"></i>
                    </a>

                        <?php
                    }
                    ?>

            </span>

        </p>


        <ul class="nav nav-tabs justify-content-center">
            <li class="active mr-5"><a data-toggle="tab" href="#timeline" style="color: #3e3f80">Timeline</a></li>
            <li class="mr-5"><a data-toggle="tab" href="#mapa" style="color: #3e3f80">Mapa</a></li>
            <li><a data-toggle="tab" href="#atividade" style="color: #3e3f80;">Atividade</a></li>
        </ul>


        <div class="tab-content">
            <div id="timeline" class="tab-pane fade in active show">

                <div class="container">
                    <div class="row">

                        <?php

                        require_once "../admin/connections/connection2db.php";

                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);

                        $query = "SELECT conteudo_publicacao
                  FROM publicacoes
                  WHERE eventos_id_evento = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_bind_param($stmt, 'i', $id_evento);

                            $id_evento = 3;

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $imagem);


                            while (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <div class="col-3 m-2 imagem_grelha"
                                     style="height: 90px; background-image: url('scripts/upload/<?= $imagem ?>'">

                                </div> <?php
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>

        </div>

    </div>

</main>
</body>
</html>


    <?php
}
}

?>