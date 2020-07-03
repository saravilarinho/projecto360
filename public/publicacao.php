<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['idp'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_publicacao = $_GET['idp'];

}

?>
<!DOCTYPE html>
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

    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Publicacao</title>

</head>


<body>


<main style="background-color: black">


    <?php


    require_once "../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT publicacoes.conteudo_publicacao, publicacoes.descricao, publicacoes.data_publicacao, utilizadores_has_publicacoes.gosto,
              utilizadores.nome_utilizador, eventos.localizacao_evento
              FROM publicacoes
              INNER JOIN utilizadores_has_publicacoes
              ON utilizadores_has_publicacoes.publicacoes_id_publicacao = publicacoes.id_publicacao
              INNER JOIN utilizadores
              ON utilizadores.id_utilizador = utilizadores_has_publicacoes.utilizadores_id_utilizador
              INNER JOIN eventos
              ON eventos.id_evento = publicacoes.eventos_id_evento
              WHERE id_publicacao = ? AND utilizadores.id_utilizador = ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_p, $id_user);

        $id_p = $id_publicacao;
        $id_user = $id_utilizador;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $conteudo, $descricao, $data, $gosto, $nome_utilizador, $localizacao);

        if (mysqli_stmt_fetch($stmt)) {

            ?>

            <div class="container">
                <div class="row">
                    <div class="visualizacao">
                        <a href="eventocomsubscricao.php?">
                            <i class="fas fa-2x fa-chevron-circle-left voltar"></i></a>
                        <img src="scripts/upload/<?=$conteudo?>" class="col-12 p-0 align-self-center">


                    </div>
                </div>
            </div>


            <div class="caixa fixed-bottom header_comentarios" id="caixa" onclick="abrir()">

                <div class="row mt-3 ml-3 mr-0">

                    <div class="col-2 d-flex justify-content-space-evenly">
                        <a class="btn botao_favorito" href="scripts/add_gosto.php?idp=<?=$id_publicacao?>">

                            <?php
                            switch ($gosto){
                                case 1:
                                    echo '<i class="fas fa-heart"></i>';
                                    break;

                                default:
                                    echo '<i class="far fa-heart"></i>';
                            }

                            ?>
                        </a>

                        <?php
                        $numero_likes = 0;

                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);

                        $query = "SELECT gosto 
                                  FROM utilizadores_has_publicacoes 
                                  WHERE gosto = 1 AND publicacoes_id_publicacao = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'i', $id_p);

                            $id_p = $id_publicacao;

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $gosto);

                            while (mysqli_stmt_fetch($stmt)) {
                                $numero_likes++;
                            }
                            ?>
                            <p class="numero_likes"><?=$numero_likes?></p>
                            <?php
                        }
                            ?>
                    </div>

                    <div class="col-2 d-flex">
                        <a class="btn botao_favorito" href="scripts/favoritar_evento.php?id=<?= $id ?>">
                            <i class="far fa-comment"></i>
                        </a>
                        <p class="numero_likes">21</p>
                    </div>

                    <div class="col-3 d-flex justify-content-center">
                        <i class="fas fa-angle-double-up"></i>
                    </div>

                    <div class="col-5">
                        <a class="btn relacionados d-flex p-1" href="scripts/favoritar_evento.php?id=<?= $id ?>">
                            <i class="far fa-images align-self-center"></i>
                            <p class="p-0 m-0">Relacionados</p></a>
                    </div>

                </div>

                <div class="row mt-1 ml-4 mr-0">
                    <small>Por <b><?=$nome_utilizador?></b></small>
                </div>

                <div class="row mt-1 ml-4 mr-0">
                    <div class="col-8 d-flex p-0">
                        <i class="fas fa-map-marker-alt"></i>
                        <small class="pl-1"><?=$localizacao?></small>
                    </div>

                    <div class="col-4 d-flex p-0">
                        <i class="far fa-calendar-alt"></i>


                        <small class="pl-1"><?=$data?></small>
                    </div>
                </div>

                <div class="comentarios container mt-4" id="comentarios">
                    <div class="comentario row pt-1 pb-1 m-0">
                        <div class="col-3 align-self-center pr-0">
                            <img class="w-75 rounded-circle" src="imagens/img_perfil.jpg">
                        </div>
                        <div class="col-7">
                            <p class="m-0 nome_comentario"><b>Leonor Lima </b></p>
                            <p class="m-0">Que foto incrível! </p>
                        </div>
                    </div>

                    <div class="comentario row pt-1 pb-1 m-0 mt-3">
                        <div class="col-3 align-self-center pr-0">
                            <img class="w-75 rounded-circle" src="imagens/img_perfil.jpg">
                        </div>
                        <div class="col-7">
                            <p class="m-0 nome_comentario"><b>Leonor Lima </b></p>
                            <p class="m-0">Que foto incrível! </p>
                        </div>
                    </div>

                    <div class="comentario row pt-1 pb-1 m-0 mt-3">
                        <div class="col-3 align-self-center pr-0">
                            <img class="w-75 rounded-circle" src="imagens/img_perfil.jpg">
                        </div>
                        <div class="col-7">
                            <p class="m-0 nome_comentario"><b>Leonor Lima </b></p>
                            <p class="m-0">Que foto incrível! </p>
                        </div>
                    </div>

                </div>


            </div>
            <?php
        }
    }
    ?>



</main>

<script src="interacoes.js"></script>
</body>
</html>