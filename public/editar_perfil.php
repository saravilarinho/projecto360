<?php
session_start();

if (isset($_SESSION['id_utilizador'])){

    $id_utilizador = $_SESSION['id_utilizador'];

}else{
    header("Location: login.php?message=3");

}


if(isset ($_GET['msg'])){
    $mensagem_de_erro = $_GET['msg'];
}

if (isset($_GET['feedback'])) {
$feedback = $_GET['feedback'];
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

    <title>Editar Perfil</title>
</head>
<body>

<header>
    <h3>
        <a href="perfil.php" style="text-decoration: none; color: #03bd03;">
            <i class="fas fa-chevron-left mr-2 ml-1"></i>
        </a>
        Editar Perfil
    </h3>

</header>
<main>
    <?php
    require_once "../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT nome_utilizador, password, foto
              FROM utilizadores
              WHERE id_utilizador = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $user);

        $user = $id_utilizador;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome_user,$password, $imagem);

        if (mysqli_stmt_fetch($stmt)) {

            ?>
            <div class="row justify-content-around mr-0">


                <div class="col-10">

                    <form enctype="multipart/form-data" action="scripts/update_evento.php?x=perfil" role="form" method="post">

                        <p class="mt-4 mb-0 text-left">Alterar Password</p>

                        <input class="p-2 mt-1 w-100 campo_form" type="password" name="password_hash_atual" value="" placeholder="Password atual ...">
                        <input class="p-2 mt-1 w-100 campo_form" type="password" name="password_hash" value="" placeholder="Nova password ...">
                        <input class="p-2 mt-1 w-100 campo_form" type="password" name="password_hash2" value="" placeholder="Confirma a nova password ...">

                        <?php

                        if (isset($mensagem_de_erro)){
                            switch ($mensagem_de_erro){
                                case 1:
                                    echo "<p class='text-danger mt-1 mb-0 text-left' style='font-size: 12px'>As passwords não são iguais.</p>";
                                    break;

                                case 2:
                                    echo "<p class='text-danger mt-1 mb-0 text-left' style='font-size: 12px'>Password incorreta, tenta de novo.</p>";

                            }
                        }


                        ?>

                        <p class="mt-4 mb-0 text-left">Alterar foto de perfil</p>

                        <?php
                        if (isset($imagem)){
                            ?>
                            <div class="uploads mt-2" style="background-image: url('scripts/upload/<?=$imagem?>'); width: auto; height: 10vh; border-radius: 10px;
                                ; text-align: center; color: white;opacity: 75%;">

                                <a data-toggle="modal" data-target="#fotografiaModal">

                                    <input name="foto" type="hidden" value="<?=$imagem?>">
                                    <p style="padding-top: 7%;"><i class="fas fa-camera" style="    font-size: x-large; !important;"></i></p>
                                </a>

                            </div>

                            <?php
                            if (isset($feedback)){
                                switch ($feedback){
                                    case 1:
                                        echo '<p class="mt-3 mb-0 text-left" style="font-size: 13px; color: #1ec5bc;">Password alterada com sucesso!</p>';
                                    break;

                                    case 2:
                                        echo '<p class="mt-3 mb-0 text-left" style="font-size: 13px; color: #1ec5bc;">Alterações guardadas com sucesso!</p>';

                                }
                            }
                        }
                        else {

                            ?>


                            <div class="uploads mt-2" style="background-color: #4E6969; width: auto; height: 10vh; border-radius: 10px; text-align: center; color: white;opacity: 65%;">
                                <a data-toggle="modal" data-target="#fotografiaModal">

                                    <p style="padding-top: 7%;"><i class="fas fa-camera" style="font-size: font-size: 30px;"></i></p>
                                </a>

                            </div>
                            <?php
                        }

                        ?>







                        <div class="fixed-bottom mb-4 justify-content-center d-flex">
                            <button type="submit" class="btn mt-3 botao_grande"> Confirmar </button>
                        </div>
                    </form>


                </div>
            </div>


            <div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos" aria-hidden="true" style="margin-top: 50%">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header modalupload">
                            <form action="scripts/upload_fotos.php?x=perfil" method="post" enctype="multipart/form-data" class="formularioupload">
                                <p>Seleciona um ficheiro e clica em upload</p>
                                <input type="file" name="file" style="font-size: 12px;padding-bottom: 20px;">
                                <input type="submit" name="submit" value="Upload" class="socorro">
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