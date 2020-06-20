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
    <title>Pesquisa</title>

</head>


<body>

<header>
    <h3>
        Pesquisa
    </h3>
</header>



<main>


    <form class="form-horizontal pesquisa mt-4" action="/action_page.php">
        <div class="form-group">
            <div class="col-sm-10">
                <input type="text" class="form-control texto_form_pesquisa" id="form_pesquisa" placeholder="Pesquisa aqui o evento que procuras">
            </div>
        </div>
    </form>

    <div>
        <p class="texto_pesquisa ml-4">Ativa a localização e desliza pelo mapa para descobrires os eventos que te rodeiam.</p>

    </div>


    <div class="ml-4">
        <?php
        include_once "geolocationtest.php";
        ?>
    </div>


    <div id="overlay" onclick="off()">
        <div id="text" class="row">

            <div class="rounded-circle overlay_icone col-5 p-3">
                <i class="far fa-3x fa-calendar-plus icone"></i>
                <p class="mb-0">Evento</p>
            </div>

            <div class="rounded-circle overlay_icone col-5 p-3" style="margin-left: 23px">
                <i class="far fa-3x fa-clone icone"></i>
                <p class="mb-0">Conteúdo</p>
            </div>

        </div>
    </div>


</main>
<footer>

    <nav class="navbar navbar-expand fixed-bottom container p-0 pt-2" style="background-color: #1ec5bc">
        <div class="row no-gutters justify-content-around w-100">
            <a class=" col-2 justify-content-center text-center" id="feed"
               href="feed.php">
                <i class="far fa-2x fa-newspaper"></i>
                <br/>
                <span class="texto-nav">FEED</span>
            </a>
            <a class="col-2  justify-content-center text-center" id="pesquisa"
               href="pesquisa.php">
                <i class="fas fa-2x fa-search"></i>
                <br/>
                <span class="texto-nav">PESQUISA</span>
            </a>
            <div onclick="on()" class="add">
                <a class="col-3 text-center" id="adicionar">
                    <i class="fas fa-2x fa-plus-circle"></i>
                    <br/>
                    <span class="texto-nav">ADICIONAR</span></a>
            </div>
            <a class="col-2  justify-content-center text-center" id="eventos"
               href="eventos.php">
                <i class="far fa-2x fa-calendar-plus"></i>
                <br/>
                <span class="texto-nav">EVENTOS</span>
            </a>
            <a class="col-2  justify-content-center text-center" id="perfil"
               href="perfil.php">
                <i class="far fa-2x fa-user"></i>
                <br/>
                <span class="texto-nav">PERFIL</span>
            </a>
        </div>
    </nav>
    <div>
    </div>
</footer>
</body>
</html>