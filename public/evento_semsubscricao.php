<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])) {
    $id_utilizador = $_SESSION['id_utilizador'] ;
    $id_evento = $_GET['id'];



}else{
    header("Location: login.php?message=2");

}



?>


<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<head>
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



    if ($imagem != ''){
        ?>
        <img class="w-100" src="scripts/upload/<?=$imagem?>">
        <?php
    }
    else {
        ?>
        <img class="w-100" src="imagens/default-image.jpg">
        <?php
    }
    ?>


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

                <?php


                require_once "../admin/connections/connection2db.php";

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "SELECT utilizadores_id_utilizador
                              FROM utilizadores_has_eventos
                              WHERE eventos_id_eventos = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $id_e);

                    $id_e = $id_evento;

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id);

                    $numero_sub = 0;

                    while (mysqli_stmt_fetch($stmt)) {

                        $numero_sub++;

                    }

                    ?>

                    <p class="col-7 texto_descricao_evento"><?= $numero_sub ?> subscitores</p>
                    <?php
                }
                ?>

                <p class="col-5 texto_descricao_evento">

                    <?php
                    if (isset($categoria)) {
                        switch ($categoria) {
                            // música
                            case 1:
                                echo '<img class="icone_categoria" src="imagens/icones/icone_musica.png"> Música</p>';
                                break;

                            // manifestações
                            case 2:
                                echo '<img class="icone_categoria" src="imagens/icones/icone_manif.png"> Manifestação</p>';
                                break;

                            // teatro
                            case 3:
                                echo '<img class="icone_categoria" src="imagens/icones/icone_teatro.png"> Teatro</p>';
                                break;

                            // festas
                            case 4:
                                echo '<img class="icone_categoria" src="imagens/icones/icone_festa.png"> Festa</p>';
                                break;
                        }
                    }
                    ?>
            </div>
        </div>

        <p class="titulo_evento mb-1"><b>Descrição</b></p>
        <p class="texto_descricao_evento"><?= $descricao?></p>

        <p class="titulo_evento mb-2 mt-3"><b>Últimas 24 horas</b></p>

        <div class="container">
            <div class="row info_evento">

                <?php
                require_once "../admin/connections/connection2db.php";

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "CALL sum_event_sub($id_evento)";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $id);

                    $subscritores_24 = 0;
                    while (mysqli_stmt_fetch($stmt)) {
                            $subscritores_24++;
                    }
                    ?>

                    <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                    <p class="texto_descricao_evento col-10"><?=$subscritores_24?> novos subscritores</p>
                    <?php
                }
                ?>
            </div>
            <div class="row info_evento">
                <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                <p class="texto_descricao_evento col-10">32 novos conteúdos</p>
            </div>

        </div>


        <?php

    }
    }


        if (isset($_GET['message'])){
            ?>

            <p class="texto_descricao_evento">O administrador irá rever o teu pedido de subscrição!</p>

            <div class="justify-content-center d-flex mt-2">


                <button class="btn botao_grande" disabled>
                    <a class="linkar_branco">
                        Pendente
                    </a>
                </button>

            </div>

            <?php
        }
        else{
            ?>
            <div class="justify-content-center d-flex mt-2">


                <button class="btn botao_grande" >
                    <a href="scripts/suscrever_evento.php?id=<?=$id_evento?>" class="linkar_branco">
                        Subscrever
                    </a>
                </button>

            </div>
        <?php

        }

?>
    </div>

</main>

</body>
</html>

SELECT utilizadores_has_eventos.utilizadores_id_utilizador, eventos.id_evento, utilizadores.nome_utilizador
FROM utilizadores_has_eventos
INNER JOIN eventos
ON utilizadores_has_eventos.eventos_id_evento = eventos.id_evento
INNER JOIN utilizadores
ON utilizadores.id_utilizador = utilizadores_has_eventos.utilizadores_id_utilizador
WHERE utilizadores_has_eventos.roles_id_role = 2 AND eventos.id_evento = id; AND utilizadores_has_eventos.data > DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY);