<!doctype html>
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

    <script src="../interacoes.js" ></script>
    <link rel="stylesheet" type="text/css" href="../estilos.css">
    <title>footer</title>
</head>

<body>

<main>
<div id="overlay" onclick="off()">


    <div id="text" class="row" style="flex-wrap: nowrap">

        <div class="overlay_icone col-6">
            <a href="criarevento.php">
                <i class="far fa-calendar-plus icone"></i>
                <p class="mb-0">Evento</p></a>

        </div>
        <div class="overlay_icone col-6 ml-3">
            <a href="carregarconteudo1.php">
            <i class="far fa-clone icone"></i>
                <p class="mb-0">Conteúdo</p></a>
        </div>

    </div>
</div>


</main>

<footer class="position-absolute">

    <nav class="navbar navbar-expand fixed-bottom container p-0 pt-2" style="background-color: #1ec5bc">
        <div class="row no-gutters justify-content-around w-100">
            <a class=" col-2 justify-content-center text-center" id="feed"
               href="feed.php">
                <i class="far fa-newspaper"></i>
                <br/>
                <span class="texto-nav">Feed</span>
            </a>
            <a class="col-2  justify-content-center text-center" id="pesquisa"
               href="pesquisa.php">
                <i class="fas fa-search"></i>
                <br/>
                <span class="texto-nav">Pesquisa</span>
            </a>
            <div onclick="on()" class="add">
                <a class="col-3 text-center" id="adicionar">
                    <i class="fas fa-plus-circle"></i>
                    <br/>
                    <span class="texto-nav">Adicionar</span>
                </a>
            </div>
            <a class="col-2  justify-content-center text-center" id="eventos"
               href="eventos.php">
                <i class="far fa-calendar-plus"></i>
                <br/>
                <span class="texto-nav">Eventos</span>
            </a>
            <a class="col-2  justify-content-center text-center" id="perfil"
               href="perfil.php">
                <i class="far fa-user"></i>
                <br/>
                <span class="texto-nav">Perfil</span>
            </a>
        </div>
    </nav>
    <div>
    </div>
</footer>

<script>
    function on() {
        document.getElementById("overlay").style.display = "block";
    }

    function off() {
        document.getElementById("overlay").style.display = "none";
    }

</script>

</body>
