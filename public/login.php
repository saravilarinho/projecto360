<?php


if(isset($_GET["message"])){

    $mensagem_erro = $_GET["message"];

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

    <script src="js/scripts.js" ></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>login</title>
</head>
<body class="container">

<div class="row justify-content-center inicio">
    <img class="col-6 align-self-center mt-5" src="imagens/logocslogan.png">
</div>

<div>

    <form class="form-horizontal mt-4" action="scripts/controlo_login.php" role="form" method="post">
        <div class="form-group">
            <div class="col-sm-10 mb-2">
                <input type="email" class="form-control texto_form_pesquisa" name="email" id="email" placeholder="E-mail">
            </div>
            <div class="col-sm-10">
                <input type="password" class="form-control texto_form_pesquisa" name="password" id="password" placeholder="Password">
            </div>

            <?php

            if (isset($mensagem_erro)){

                //outras mensagens

                if ($mensagem_erro = 1){ echo "<p class='col-sm-10 text-danger mt-2 mb-0 text-left' style='font-size: 12px'>E-mail ou password incorretos. Tente de novo. </p>"; }

                if ($mensagem_erro = 2){ echo "<p class='col-sm-10 text-danger mt-2 mb-0 text-left' style='font-size: 12px'>Ocorreu um erro. Tenta de novo.</p>"; }


            }
            ?>


            <div class="justify-content-center d-flex">
                <button type="submit" class="btn mt-3 botao_grande"> Entrar </button>
            </div>
        </div>
    </form>

</div>



</body>
</html>