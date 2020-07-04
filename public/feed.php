<?php
session_start();


if (isset($_SESSION['id_utilizador'])) {
    $id_utilizador = $_SESSION['id_utilizador'] ;

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

    <title>Feed</title>

</head>


<body>

<header>
    <h3>
        Feed
    </h3>

</header>

<main>

    <div class="container">

    <div class="mt-4">
        <div class="row col-12 card_horizontal p-2 ml-0">
            <div class="d-flex">
                <div class="col-3 align-self-center">
                    <img class="w-100 rounded-circle ml-2" src="imagens/img_perfil.jpg">
                </div>
                <div class="col-6 align-self-center">
                    <p class="texto_card_historico"><b> Garagem do Reitor</b> alterou o seu horário.</p>
                    <img class="icone_categoria" src="imagens/icones/icone_festa.png"> <small class="small_feed">há 1 dia</small>
                </div>
                <div class="col-2 align-self-center">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="row col-12 card_horizontal p-2 ml-0">
            <div class="d-flex">
                <div class="col-3 align-self-center">
                    <img class="w-100 rounded-circle ml-2" src="imagens/img_perfil.jpg">
                </div>
                <div class="col-6 align-self-center">
                    <p class="texto_card_historico"><b> Garagem do Reitor</b> alterou o seu horário.</p>
                    <img class="icone_categoria" src="imagens/icones/icone_festa.png"> <small class="small_feed">há 1 dia</small>
                </div>
                <div class="col-2 align-self-center">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="row col-12 card_horizontal p-2 ml-0">
            <div class="d-flex">
                <div class="col-3 align-self-center">
                    <img class="w-100 rounded-circle ml-2" src="imagens/img_perfil.jpg">
                </div>
                <div class="col-6 align-self-center">
                    <p class="texto_card_historico"><b> Garagem do Reitor</b> alterou o seu horário.</p>
                    <img class="icone_categoria" src="imagens/icones/icone_festa.png"> <small class="small_feed">há 1 dia</small>
                </div>
                <div class="col-2 align-self-center">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>

    </div>
</main>


    <?php

include_once "components/footer.php";


?>


</body>
</html>