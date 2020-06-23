<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_evento = $_GET['id'];

}


if(isset ($_GET['msg'])&& isset ($_GET['id'])){
    $user = $_GET['id'];
    $mensagem_de_erro = $_GET['msg'];
}

if(isset($_GET["nome"])){
    $imagem = $_GET["nome"];
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
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="937588741569-d3fubg088md23rede8sllanc4erir62s.apps.googleusercontent.com">

    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Editar Evento</title>
</head>
<body>

<header>
    <h3>
        <a href="eventocomsubscricao.php?id=<?=$id_evento?>" style="text-decoration: none; color: #03bd03;">
            <i class="fas fa-chevron-left mr-2 ml-1"></i>
        </a>
        Editar Evento
    </h3>

</header>
<main>
    <?php
    require_once "../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_evento, nome_evento, data_inicio_evento, data_fim_evento, localizacao_evento, 
descricao_evento, categorias_id_categoria, niveis_privacidade_id_nivel_privacidade, imagem_evento
    FROM eventos
    INNER JOIN utilizadores_has_eventos
    ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento
    WHERE utilizadores_has_eventos.utilizadores_id_utilizador = ? AND eventos.id_evento = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'ii', $user, $evento);

    $user = $id_utilizador;
    $evento = $id_evento;

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_ev,$nome_evento, $data_inicio, $data_fim, $localizacao, $descricao,
        $categoria, $privacidade, $imagem);

    if (mysqli_stmt_fetch($stmt)) {

?>


    <p class="mt-3 ml-4"><?=$nome_evento ?></p>
    <p class="mt-0 ml-4">Começa por preencher os seguintes campos com as tuas informações.</p>

    <div class="row justify-content-around mr-0">


        <div class="col-10">

            <form enctype="multipart/form-data" action="scripts/update_evento.php?id=<?=$id_ev?>" role="form" method="post">

                <p class="mt-2 mb-0 text-left">Nome do Evento</p>
                <input class="pl-2 mt-1 w-100" type="text" name="nomeevento" placeholder="<?=$nome_evento ?>"
                       required="required">

                <p class="mt-2 mb-0 text-left">Descrição</p>
                <input class="pl-2 mt-1 w-100" type="text" name="descricao" placeholder="<?=$descricao ?>"
                       required="required">

                <p class="mt-2 mb-0 text-left">Data do evento</p>
                <input class="pl-2 mt-1 w-100" type="date" name="datainicio" required="required" placeholder="<?=$data_inicio ?>">

                <input class="pl-2 mt-1 w-100" type="date" name="datafim" required="required" placeholder="<?=$data_fim ?>">

                <p class="mt-2 mb-0 text-left">Localização</p>
                <input class="pl-2 mt-1 w-100" type="text" name="localizacao" required="required" placeholder="<?=$localizacao ?>">

                <p class="mt-2 mb-0 text-left">Privacidade</p>

                <p class="mt-2 mb-0 text-left">Imagem de capa</p>

                <div class="mt-4 mb-0 text-center">
                    <a data-toggle="modal" data-target="#fotografiaModal">
                        <button class="btn btn-dark col-4" style="width: 150px;
    height: 90px;border-radius: 50%; background-color: #2C3335;border: none; color: white; padding: 20px; text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;"><i class="fa fa-2x fa-camera"></i> Upload </button>
                        <?php
                        if(isset($imagem)) {
                            echo "<p class='form-control-file col-md-4' style='display: block; !important;'> $imagem </p>";
                        }
                        else {
                            echo "<p class='form-control-file col-md-4' style='display: block; !important;'> Nenhum novo ficheiro selecionado. </p>";

                        }

                        ?>
                    </a>
                </div>



                <div class="justify-content-center d-flex">
                    <button type="submit" class="btn mt-3 botao_grande"> Confirmar </button>
                </div>
            </form>


        </div>
    </div>


        <div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos" aria-hidden="true" style="margin-top: 50%">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <form class="row justify-content-center pb-5" action="scripts/upload_fotos.php?id=<?=$id_evento?>" enctype="multipart/form-data" method="post"  style="margin: auto">
                            <input style="cursor: pointer!important;" class="col-8 p-3 pb-5 form-control inputRegistar mt-4 btn btn-outline-dark" type="file" placeholder="File" name="fileToUpload" id="fileToUpload">

                            <input class="col-8 form-control inputRegistar mt-4 btn" type="submit" style="background-color: darkgreen;
    color: white;" value="Upload" name="submit">
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



</body>


</html>