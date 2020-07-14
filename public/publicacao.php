<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['idp'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_publicacao = $_GET['idp'];

}else{
    header("Location: login.php?message=2");

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


<body onload="altura()" style="background-color: black !important;">


<main class="mb-0">


    <?php


    require_once "../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT publicacoes.eventos_id_evento, publicacoes.conteudo_publicacao, publicacoes.descricao, publicacoes.data_publicacao, utilizadores_has_publicacoes.gosto,
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
        mysqli_stmt_bind_result($stmt, $id_evento, $conteudo, $descricao, $data, $gosto, $nome_utilizador, $localizacao);

        if (mysqli_stmt_fetch($stmt)) {

            ?>

            <div class="container">
                <div class="row">
                    <div class="visualizacao">
                        <a href="eventocomsubscricao.php?id=<?= $id_evento ?>">
                            <i class="fas fa-2x fa-chevron-circle-left voltar"></i></a>
                        <img id="pub" src="scripts/upload/<?= $conteudo ?>" class="col-12 p-0 align-self-center">

                    </div>
                </div>
            </div>

            <script type="text/javascript">

                function altura() {

                    var img = document.getElementById("pub");
                    var height = parseInt(img.clientHeight);
                    var minimo = parseInt("300px");
                    var medio = parseInt("400px");
                    console.log(minimo);
                    console.log(height);

                    if (height <= minimo) {
                        console.log("pequena");
                        console.log(height);
                        img.style.marginTop = "8rem";
                    }

                    if (height > minimo && height < medio) {
                        console.log("media");
                        img.style.marginTop = "5rem";

                    }

                    if (height > medio) {
                        console.log("grande");
                        img.style.marginTop = "0";
                    }
                }
            </script>

            <div class="caixa fixed-bottom header_comentarios" id="caixa">

                <div class="row mt-3 ml-3 mr-0" onclick="abrir()">

                    <div class="col-2 d-flex justify-content-space-evenly">
                        <a class="btn botao_favorito" href="scripts/add_gosto.php?idp=<?= $id_publicacao ?>">

                            <?php
                            switch ($gosto) {
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
                            <p class="numero_likes"><?= $numero_likes ?></p>
                            <?php
                        }
                        ?>
                    </div>


                    <?php


                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_comentario
                              FROM comentarios
                              WHERE publicacoes_id_publicacao = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $id_pub);

                        $id_pub = $id_publicacao;

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id);

                        $numero_comentarios = 0;

                        while (mysqli_stmt_fetch($stmt)) {

                            $numero_comentarios++;

                        }

                        ?>


                        <div class="col-2 d-flex">
                            <a class="btn botao_favorito" href="">
                                <i class="far fa-comment"></i>
                            </a>
                            <p class="numero_likes"><?=$numero_comentarios?></p>
                        </div>
                        <?php
                    }
                        ?>




                    <div class="col-3 d-flex justify-content-center">
                        <i class="fas fa-angle-double-up" id="subir"></i>
                        <i class="fas fa-angle-double-down" id="descer"></i>
                    </div>

                    <div class="col-5">
                        <a class="btn relacionados d-flex p-1" href="">
                            <i class="far fa-images align-self-center"></i>
                            <p class="p-0 m-0">Relacionados</p></a>
                    </div>

                </div>

                <div class="row mt-1 ml-4 mr-0">
                    <small>Por <b><?= $nome_utilizador ?></b></small>
                </div>

                <div class="row mt-1 ml-4 mr-0">
                    <div class="col-8 d-flex p-0">
                        <i class="fas fa-map-marker-alt"></i>
                        <small class="pl-1"><?= $localizacao ?></small>
                    </div>

                    <div class="col-4 d-flex p-0">
                        <i class="far fa-calendar-alt"></i>


                        <small class="pl-1"><?= $data ?></small>
                    </div>
                </div>

                <div class="comentarios container mt-4" id="comentarios">


                    <?php


                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT comentarios.comentario, utilizadores.nome_utilizador, utilizadores.foto
                              FROM comentarios
                              INNER JOIN utilizadores
                              ON comentarios.utilizadores_id_utilizador = utilizadores.id_utilizador
                              WHERE comentarios.publicacoes_id_publicacao = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $id_pub);

                        $id_pub = $id_publicacao;

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $comentario, $nome_user, $foto);


                        while (mysqli_stmt_fetch($stmt)) {

                            ?>


                            <div class="comentario row pt-1 pb-1 m-0 mb-2">
                                <div class="col-3 align-self-center pr-0">
                                    <img class="w-75 rounded-circle" src="scripts/upload/<?=$foto?>">
                                </div>
                                <div class="col-7">
                                    <p class="m-0 nome_comentario"><b><?=$nome_user?></b></p>
                                    <p class="m-0 comentario_texto"><?=$comentario?></p>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>





                    <div class="add_comentario fixed-bottom row m-0">
                        <div class="align-self-center">
                            <form action="scripts/add_comentario.php?idp=<?=$id_publicacao?>" role="form" method="post" class="d-flex">
                            <div class="field col-10">
                                <input type="text" name="comentario" value="" placeholder="Adiciona o teu comentário..." class="p-1 campo_form" style="width: 245px">
                            </div>

                            <!--<div class="col-2 ml-3 text-right">
                                <btn type="submit"><i class="fas fa-check"></i> </btn>
                            </div>-->

                            </form>
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