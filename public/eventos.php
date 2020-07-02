<?php

session_start();


if (isset($_SESSION['id_utilizador'])){
    $id_utilizador = $_SESSION['id_utilizador'];

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

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
    <title>Eventos</title>

</head>

<body>
<header>
    <h3>
        Eventos
    </h3>
</header>

<main style="padding-bottom: 25% !important;">

    <div class="container mt-4">
        <ul class="nav nav-tabs justify-content-center">
            <li class="active mr-4"><a data-toggle="tab" href="#home">Meus Eventos</a></li>
            <li class="mr-4"><a data-toggle="tab" href="#menu2">Subscritos</a></li>
            <li><a data-toggle="tab" href="#menu3">Favoritos</a></li>
        </ul>

        <div class="tab-content">

    <?php

    require_once "../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


                        $query = "SELECT utilizadores.id_utilizador, utilizadores.nome_utilizador,
                        utilizadores_has_eventos.eventos_id_evento, utilizadores_has_eventos.roles_id_role, utilizadores_has_eventos.favorito,
                        eventos.nome_evento, eventos.data_inicio_evento, eventos.localizacao_evento, eventos.categorias_id_categoria, eventos.imagem_evento
                        FROM utilizadores
                        INNER JOIN utilizadores_has_eventos
                        ON utilizadores.id_utilizador = utilizadores_has_eventos.utilizadores_id_utilizador
                        INNER JOIN eventos
                        ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento
                        WHERE utilizadores.id_utilizador = ? AND utilizadores_has_eventos.roles_id_role = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            ?>


            <!--MEUS EVENTOS-->

            <div id="home" class="tab-pane fade in active show">
                <div class="container">
                    <div class="row row-cols-2 mt-4">

                        <?php

                        mysqli_stmt_bind_param($stmt, 'ii', $id, $id_role);

                        $id = $_SESSION['id_utilizador'];
                        $id_role = 1;

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id, $nome_utilizador, $id_evento, $role_evento, $favorito, $nome_evento, $data_evento, $localizacao, $categoria, $imagem);


                        while (mysqli_stmt_fetch($stmt)) {
                            ?>


                        <div class="col align-content-center mb-2">
                            <div class="card_vertical h-100">
                                <a class="linkar" href="eventocomsubscricao.php?id=<?=$id_evento?>">
                                    <?php
                                    if ($imagem != ''){
                                        ?>
                                        <img src="scripts/upload/<?=$imagem?>" class="card-img-top" alt="...">
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                        <?php
                                    }

                                    ?>
                                    <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b> <?php echo $nome_evento ?></b>
                                        </p>

                                        <?php
                                        if (isset($categoria)) {
                                            switch ($categoria) {
                                                // música
                                                case 1:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_musica.png">';
                                                    break;

                                                // manifestações
                                                case 2:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_manif.png">';
                                                    break;

                                                // teatro
                                                case 3:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_teatro.png">';
                                                    break;

                                                // festas
                                                case 4:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_festa.png">';
                                                    break;
                                            }
                                        }
                                        ?>


                                    </div>
                                    <p class="card-text texto_card_eventos m-0">
                                        <small><?php echo $data_evento?></small>
                                    </p>
                                    <p class="card-text texto_card_eventos m-0">
                                        <small> <?= $localizacao ?></small>
                                    </p>
                                </div>

                                </a>
                            </div>
                        </div>


                            <?php
                        } ?>

                    </div>
                </div>

            </div>


            <!--Subscritos-->

            <div id="menu2" class="tab-pane fade">
                <div class="container">
                    <div class="row row-cols-2 mt-4">

                        <?php


                        mysqli_stmt_bind_param($stmt, 'ii', $id, $id_role);

                        $id = $_SESSION['id_utilizador'];
                        $id_role = 2;

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id, $nome_utilizador, $id_evento, $role_evento,$favorito, $nome_evento, $data_evento, $localizacao, $categoria, $imagem);


                        while (mysqli_stmt_fetch($stmt)) {

                        ?>


                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <a class="linkar" href="eventocomsubscricao.php?id=<?=$id_evento?>">
                                    <?php
                                    if ($imagem != ''){
                                        ?>
                                        <img src="scripts/upload/<?=$imagem?>" class="card-img-top" alt="...">
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                        <?php
                                    }

                                    ?>
                                    <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b><?=$nome_evento ?></b></p>

                                        <?php
                                        if (isset($categoria)) {
                                            switch ($categoria) {
                                                // música
                                                case 1:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_musica.png">';
                                                    break;

                                                // manifestações
                                                case 2:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_manif.png">';
                                                    break;

                                                // teatro
                                                case 3:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_teatro.png">';
                                                    break;

                                                // festas
                                                case 4:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_festa.png">';
                                                    break;
                                            }
                                        }
                                        ?>



                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small><?=$data_evento ?></small></p>
                                    <p class="card-text texto_card_eventos m-0"><small><?=$localizacao ?></small>
                                    </p>
                                </div>
                                    </a>
                            </div>
                        </div>

                        <?php }
                        ?>
                    </div>

                    <?php } ?>

                </div>

            </div>

            <!--Favoritos-->

            <div id="menu3" class="tab-pane fade">
                <div class="container">
                    <div class="row row-cols-2 mt-4">


                        <?php

                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);


                        $query = "SELECT utilizadores.id_utilizador, utilizadores.nome_utilizador,
                        utilizadores_has_eventos.eventos_id_evento, utilizadores_has_eventos.roles_id_role, utilizadores_has_eventos.favorito,
                        eventos.nome_evento, eventos.data_inicio_evento, eventos.localizacao_evento, eventos.categorias_id_categoria, eventos.imagem_evento
                        FROM utilizadores
                        INNER JOIN utilizadores_has_eventos
                        ON utilizadores.id_utilizador = utilizadores_has_eventos.utilizadores_id_utilizador
                        INNER JOIN eventos
                        ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento
                        WHERE utilizadores.id_utilizador = ? AND utilizadores_has_eventos.favorito = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'ii', $id, $favoritos);

                        $id = $_SESSION['id_utilizador'];
                        $favoritos = 1;

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id, $nome_utilizador, $id_evento, $role_evento, $favorito, $nome_evento, $data_evento, $localizacao, $categoria, $imagem);


                        while (mysqli_stmt_fetch($stmt)) {

                        ?>


                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <a class="linkar" href="eventocomsubscricao.php?id=<?=$id_evento?>">
                                <?php
                                if ($imagem != ''){
                                    ?>
                                    <img src="scripts/upload/<?=$imagem?>" class="card-img-top" alt="...">
                                    <?php
                                }
                                else {
                                    ?>
                                    <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                    <?php
                                }

                                ?>

                                <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b> <?= $nome_evento ?> </b></p>

                                        <?php
                                        if (isset($categoria)) {
                                            switch ($categoria) {
                                                // música
                                                case 1:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_musica.png">';
                                                    break;

                                                // manifestações
                                                case 2:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_manif.png">';
                                                    break;

                                                // teatro
                                                case 3:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_teatro.png">';
                                                    break;

                                                // festas
                                                case 4:
                                                    echo '<img class="icone_categoria" src="imagens/icones/icone_festa.png">';
                                                    break;
                                            }
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    $date = date('d-m-Y', strtotime($data_evento)); //date format

                                    ?>
                                    <p class="card-text texto_card_eventos m-0"><small><?= $date ?></small></p>



                                    <p class="card-text texto_card_eventos m-0"><small><?= $localizacao ?></small>
                                    </p>
                                </div>
                                </a>
                            </div>
                        </div>

                        <?php }
                        ?>

                    </div>
                    <?php }
                    ?>
                </div>


            </div>
        </div>
    </div>


</main>

<?php include_once "components/footer.php";  ?>

</body>


</html>

