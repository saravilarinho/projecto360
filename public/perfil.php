<?php
session_start();
if (isset($_SESSION['id_utilizador'])){

    $id_utilizador = $_SESSION['id_utilizador'];

}
else {
    header("Location: login.php?message=2");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500&display=swap" rel="stylesheet">

    <!-- Ligacoes -->
    <script src="interacoes.js" ></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>

    <title>Perfil</title>

</head>


<body>

<header>
    <h3>

        Perfil
        <a href="scripts/log_out.php" style="text-decoration: none; color: #03bd03;margin-left: 67% !important;">
            <i class="fas fa-sign-out-alt"></i>
        </a>

    </h3>
</header>

<main>

    <?php


    require_once "../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_utilizador, nome_utilizador, foto, eventos_criados, eventos_subscritos, conteudos_partilhados
                  FROM utilizadores
                  WHERE id_utilizador = $id_utilizador";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $nome, $foto, $eventos_criados, $eventos_subscritos, $conteudos_partilhados);


        if (mysqli_stmt_fetch($stmt)) {

            ?>

    <div class="text-center mt-4 col-12">

        <div>
        <img class="corte" src="scripts/upload/<?=$foto?>"></div>

        <h4 class="mt-2">

            <?php echo $nome ?> </h4>

        <span class=" col-2">
            <a  id="edit" style="padding: 5px;" href="editar_perfil.php?id=<?=$id?>">
                    <i class="fas fa-user-edit"></i>
            </a>
        </span>
    </div>

    <div class="container">

        <ul class="nav nav-tabs justify-content-around">
            <li class="active"><a data-toggle="tab" href="#home" style="color: #3e3f80">Stats</a></li>
            <li class=""><a data-toggle="tab" href="#menu2" style="color: #3e3f80">Histórico</a></li>
        </ul>


        <div class="tab-content">
            <div id="home" class="tab-pane fade in active show">
                <div class="container">
                    <?php
                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                      $query = "SELECT eventos.id_evento, eventos.imagem_evento 
                                FROM eventos 
                                INNER JOIN utilizadores_has_eventos 
                                ON utilizadores_has_eventos.eventos_id_evento = eventos.id_evento 
                                WHERE utilizadores_has_eventos.utilizadores_id_utilizador = ? 
                                AND utilizadores_has_eventos.roles_id_role = 1
                                ORDER BY eventos.id_evento
                                LIMIT 4";


                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $id_utili);

                    $id_utili = $id_utilizador;

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $id_evento, $imagem);
                    ?>


                    <div class="card_horizontal text-center mt-4 mx-auto w-100">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <p class="mt-2 mb-0 pl-2 titulo_card_stats"><?php echo $eventos_criados ?></p>
                                <p class="mb-2 mt-0 pl-2 titulo_card_stats">Eventos Criados</p>
                            </div>
                            <div class="d-flex col-6 align-middle">
                                <?php

                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($imagem != ''){
                                        ?>
                                        <img class="rounded-circle img_card_stats"
                                             src="scripts/upload/<?=$imagem?>">
                                        <?php
                                    }else {
                                        ?>

                                        <img class="rounded-circle img_card_stats"
                                             src="imagens/default-image.jpg">

                                        <?php
                                    }
                                }

                                ?>

                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>


                    <?php
                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT eventos.id_evento, eventos.imagem_evento 
                                FROM eventos 
                                INNER JOIN utilizadores_has_eventos 
                                ON utilizadores_has_eventos.eventos_id_evento = eventos.id_evento 
                                WHERE utilizadores_has_eventos.utilizadores_id_utilizador = ? 
                                AND utilizadores_has_eventos.roles_id_role = 2
                                ORDER BY eventos.id_evento
                                LIMIT 4";


                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $id_utili);

                    $id_utili = $id_utilizador;

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $id_evento, $imagem);
                    ?>

                    <div class="card_horizontal text-center mt-4 mx-auto">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <p class="mt-2 mb-0 pl-2 titulo_card_stats"><?php echo $eventos_subscritos?></p>
                                <p class="mb-2 mt-0 pl-2 titulo_card_stats">Eventos Subscritos</p>
                            </div>
                            <div class="d-flex col-6 align-middle">
                                <?php

                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($imagem != ''){
                                        ?>
                                        <img class="rounded-circle img_card_stats"
                                             src="scripts/upload/<?=$imagem?>">
                                        <?php
                                    }else {
                                        ?>

                                        <img class="rounded-circle img_card_stats"
                                             src="imagens/default-image.jpg">

                                        <?php
                                    }
                                }

                                ?>

                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT publicacoes.id_publicacao, publicacoes.conteudo_publicacao
                                FROM publicacoes 
                                INNER JOIN utilizadores_has_publicacoes
                                ON utilizadores_has_publicacoes.publicacoes_id_publicacao = publicacoes.id_publicacao
                                WHERE utilizadores_has_publicacoes.utilizadores_id_utilizador = ? 
                                AND utilizadores_has_publicacoes.criacao_publicacao = 1
                                ORDER BY publicacoes.id_publicacao
                                LIMIT 4";


                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $id_utili);

                    $id_utili = $id_utilizador;

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $id_pub, $imagem_pub);
                    ?>
                    <div class="card_horizontal text-center mt-4 mx-auto">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <p class="mt-2 mb-0 pl-2 titulo_card_stats"><?php echo $conteudos_partilhados?></p>
                                <p class="mb-2 mt-0 pl-2 titulo_card_stats">Conteúdos Partilhados</p>
                            </div>
                            <div class="d-flex col-6 align-middle">
                                <?php

                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($imagem_pub != ''){
                                        ?>
                                        <img class="rounded-circle img_card_stats"
                                             src="scripts/upload/<?=$imagem_pub?>">
                                        <?php
                                    }else {
                                        ?>

                                        <img class="rounded-circle img_card_stats"
                                             src="imagens/default-image.jpg">

                                        <?php
                                    }
                                }

                                ?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="mt-3 ml-3">
                <?php
                require_once "../admin/connections/connection2db.php";

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "CALL historico()";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $nome, $data, $categoria, $imagem);

                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                            <div class="row mb-1">
                            <div class="col-3">
                                <?php
                                    if ($imagem != ''){
                                        ?>
                                        <img  class="img_historico rounded-circle"
                                              src="scripts/upload/<?=$imagem?>">
                                        <?php
                                    }
                                    else {
                                        ?>

                                        <img  class="img_historico rounded-circle"
                                              src="imagens/default-image.jpg">

                                        <?php
                                    }

                                ?>
                            </div>
                                <div class="col-6">
                                    <p class="titulo_card_historico"> <?=$nome?></p>
                                    <p class="texto_card_historico"> <?=$data?></p>
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
                            </div>
                        <hr>
                        <?php
                } }

                ?>
            </div>


        </div>
    </div>

</main>


<?php
}

    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection



include_once "components/footer.php";
?>



</body>
</html>