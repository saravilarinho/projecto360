<?php

session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_evento = $_GET['id'];

}


require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT nome_evento, data_inicio_evento, data_fim_evento, localizacao_evento, descricao_evento, 
categorias_id_categoria, imagem_evento, coor_lat, coor_long, utilizadores_has_eventos.favorito, utilizadores_has_eventos.roles_id_role
          FROM eventos
          INNER JOIN utilizadores_has_eventos
          ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento
          WHERE id_evento = ?";


if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id);

    $id = $id_evento;
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome_evento,  $data_inicio, $data_fim, $localizacao, $descricao, $categoria, $imagem, $lat, $lng, $favorito, $id_role);

    if (mysqli_stmt_fetch($stmt)) {

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
    <title><?=$nome_evento ?></title>

</head>
<body>
<main>

    <a href="eventos.php">
    <i class="fas fa-2x fa-chevron-circle-left voltar"></i></a>
    <img class="w-100" src="scripts/upload/<?=$imagem?>">

    <div class="pl-4 container superior_redondo">

        <p class="titulo_evento mb-3 mt-3 col-10">
            <?=$nome_evento ?>
            <span class="alinhar_fav col-2">
            <a class="btn botao_favorito" href="scripts/favoritar_evento.php?id=<?=$id?>">
                    <?php
                    if ($favorito === 0){
                        ?>
                            <i class="far fa-star" style="font-size: 15px;"></i>
                            <?php
                    }
                    else {
                        ?><i class="fas fa-star" style="font-size: 15px;"></i>
                            <?php
                    }

                    ?>
            </a>

                    <?php
                    if ($id_role === 1){
                        ?>
                <a class="btn botao_favorito" href="editar_evento.php?id=<?=$id?>">
                        <i class="far fa-edit" style="font-size: 15px;"></i>
                    </a>

                        <?php
                    }
                    ?>

            </span>

        </p>



        <ul class="nav nav-tabs justify-content-center">
            <li class="active mr-5"><a data-toggle="tab" href="#timeline">Timeline</a></li>
            <li class="mr-5"><a data-toggle="tab" href="#mapa">Mapa</a></li>
            <li><a data-toggle="tab" href="#atividade">Atividade</a></li>
        </ul>


        <div class="tab-content">
            <div id="timeline" class="tab-pane fade in active show">

                <div class="order-timeline">
                    <div class="timeline-object complete">
                        <div class="timeline-status"></div>
                        <div class="timeline-p">
                            <div class="hora">10:30</div>
                            <div class="fotografias">
                                <div>
                                    <img class="img_timeline" src="imagens/evento1.jpeg">
                                    <img class="img_timeline" src="imagens/evento2.jpeg">
                                    <img class="img_timeline" src="imagens/evento1.jpeg"></div>
                                <div class="mt-2">
                                    <img class="img_timeline" src="imagens/evento2.jpeg">
                                    <img class="img_timeline" src="imagens/evento1.jpeg">
                                    <img class="img_timeline" src="imagens/evento2.jpeg">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-object complete">
                        <div class="timeline-status"></div>
                        <div class="timeline-p">
                            <div class="hora">11:30</div>
                            <div class="fotografias">
                                <img class="img_timeline" src="imagens/evento1.jpeg">
                                <img class="img_timeline" src="imagens/evento1.jpeg">
                            </div>
                        </div>
                    </div>

                    <div class="timeline-object complete">
                        <div class="timeline-status"> </div>
                        <div class="timeline-p">
                            <div class="fotografias">
                                <img class="img_timeline" src="imagens/evento1.jpeg">
                                <img class="img_timeline" src="imagens/evento1.jpeg">
                            </div>
                        </div>
                    </div>

                    <div class="timeline-object complete">
                        <div class="timeline-status"> </div>
                        <div class="timeline-p">
                            <div class="fotografias">
                                <img class="img_timeline" src="imagens/evento1.jpeg">
                                <img class="img_timeline" src="imagens/evento1.jpeg">
                            </div>
                        </div>
                    </div>

                    <div class="timeline-object complete">
                        <div class="timeline-status"> </div>
                        <div class="timeline-p">
                        </div>
                    </div>
                </div>
            </div>


            <div id="mapa" class="tab-pane fade in">
                <?php
                include_once "mapacomeventos.php";
                ?>
            </div>

            <div id="atividade" class="tab-pane fade in">
                <div class="container mt-4">
                    <div class="row align-items-center">
                        <img class="col-2 align-self-center" src="imagens/icones/icone_festa.png">
                        <p class="col-10 align-self-center"><small>António Monteiro adicionou 8 novos
                            conteúdos. </small></p>
                    </div>

                    <div class="row">
                        <img class="col-2 align-self-center" src="imagens/icones/icone_festa.png">
                        <p class="col-10"><small>Laura Santos subscreveu o evento. </small></p>
                    </div>

                    <div class="row">
                        <img class="col-2 align-self-center" src="imagens/icones/icone_festa.png">
                        <p class="col-10"><small>António Monteiro adicionou 8 novos conteúdos.</small></p>
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