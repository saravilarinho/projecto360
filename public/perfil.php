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

        <img style="width: 125px;" class="rounded-circle" src="scripts/upload/<?=$foto?>">

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
            <li class="active"><a data-toggle="tab" href="#home">Stats</a></li>
            <li class=""><a data-toggle="tab" href="#menu2">Histórico</a></li>
        </ul>


        <div class="tab-content">
            <div id="home" class="tab-pane fade in active show">
                <div class="container">
                    <div class="card_perfil mt-4 mx-auto w-100">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <p class="mt-2 mb-0 pl-2 titulo_card_stats"><?php echo $eventos_criados?></p>
                                <p class="mb-2 mt-0 pl-2 titulo_card_stats">Eventos Criados</p>
                            </div>
                            <div class="imgs-stats col-6 align-middle">
                                <img class="rounded-circle img_card_stats"
                                     src="imagens/img_perfil.jpg">
                                <img class="rounded-circle img_card_stats"
                                     src="imagens/img_perfil.jpg">

                            </div>
                        </div>
                    </div>

                    <div class="card_perfil mt-4 mx-auto">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <p class="mt-2 mb-0 pl-2 titulo_card_stats"><?php echo $eventos_subscritos?></p>
                                <p class="mb-2 mt-0 pl-2 titulo_card_stats">Eventos Subscritos</p>
                            </div>
                            <div class="imgs-stats col-6 align-middle">
                                <img class="rounded-circle img_card_stats"
                                     src="imagens/img_perfil.jpg">
                                <img class="rounded-circle img_card_stats"
                                     src="imagens/img_perfil.jpg">

                            </div>
                        </div>
                    </div>

                    <div class="card_perfil mt-4 mx-auto">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <p class="mt-2 mb-0 pl-2 titulo_card_stats"><?php echo $conteudos_partilhados?></p>
                                <p class="mb-2 mt-0 pl-2 titulo_card_stats">Conteúdos Partilhados</p>
                            </div>
                            <div class="imgs-stats col-6 align-middle">
                                <img class="rounded-circle img_card_stats"
                                     src="imagens/img_perfil.jpg">
                                <img class="rounded-circle img_card_stats"
                                     src="imagens/img_perfil.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">

                <div class="mt-3 ml-3">
                    <div class="row">

                        <img class="col-4 img_historico rounded-circle" src="imagens/img_perfil.jpg">
                        <div class="col-6">
                            <p class="titulo_card_historico"> Garagem do Reitor</p>
                            <p class="texto_card_historico"> 15 de Março de 2020</p>
                            <img class="icone_categoria" src="imagens/icones/icone_festa.png"></div>
                    </div>
                    <hr>

                </div>

                <div class="mt-2 ml-3">
                    <div class="row">
                        <img class="col-4 img_historico rounded-circle" src="imagens/img_perfil.jpg">
                        <div class="col-6">
                            <p class="titulo_card_historico"> Garagem do Reitor</p>
                            <p class="texto_card_historico"> 15 de Março de 2020</p>
                            <img class="icone_categoria" src="imagens/icones/icone_festa.png"></div>
                    </div>
                    <hr>

                </div>

                <div class="mt-2 ml-3">
                    <div class="row">
                        <img class="col-4 img_historico rounded-circle" src="imagens/img_perfil.jpg">
                        <div class="col-6">
                            <p class="titulo_card_historico"> Garagem do Reitor</p>
                            <p class="texto_card_historico"> 15 de Março de 2020</p>
                            <img class="icone_categoria" src="imagens/icones/icone_festa.png"></div>
                    </div>
                    <hr>

                </div>

                <div class="mt-2 ml-3">
                    <div class="row">
                        <img class="col-4 img_historico rounded-circle" src="imagens/img_perfil.jpg">
                        <div class="col-6">
                            <p class="titulo_card_historico"> Garagem do Reitor</p>
                            <p class="texto_card_historico"> 15 de Março de 2020</p>
                            <img class="icone_categoria" src="imagens/icones/icone_festa.png"></div>
                    </div>
                </div>
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