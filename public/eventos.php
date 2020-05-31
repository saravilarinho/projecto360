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

    <script src="js/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Eventos</title>

</head>

<body>
<header>
    <h3>
        Eventos
    </h3>
</header>

<main>

    <div class="container mt-4">
        <ul class="nav nav-tabs justify-content-center">
            <li class="active mr-4"><a data-toggle="tab" href="#home">Meus Eventos</a></li>
            <li class="mr-4"><a data-toggle="tab" href="#menu2">Favoritos</a></li>
            <li><a data-toggle="tab" href="#menu3">Subscritos</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active show">
                <div class="container">
                    <div class="row row-cols-2 mt-4">
                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b>Garagem do Reitor</b></p>
                                        <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small>16 de Março</small></p>
                                    <p class="card-text texto_card_eventos m-0"><small>Parque das Nações, Lisboa</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                <div class="card-body pb-1">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b>Encontro Nacional de
                                            Design</b></p>
                                        <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small>16 de Março</small></p>
                                    <p class="card-text texto_card_eventos m-0"><small>Parque das Nações, Lisboa</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="menu2" class="tab-pane fade">
                <div class="container">
                    <div class="row row-cols-2 mt-4">
                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b>Encontro Nacional de
                                            Design</b></p>
                                        <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small>16 de Março</small></p>
                                    <p class="card-text texto_card_eventos m-0"><small>Parque das Nações, Lisboa</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col align-content-center">
                        </div>
                    </div>
                </div>

            </div>
            <div id="menu3" class="tab-pane fade">
                <div class="container">
                    <div class="row row-cols-2 mt-4">
                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b>Encontro Nacional de
                                            Design</b></p>
                                        <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small>16 de Março</small></p>
                                    <p class="card-text texto_card_eventos m-0"><small>Parque das Nações, Lisboa</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                <div class="card-body pb-1">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b>Encontro Nacional de
                                            Design</b></p>
                                        <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small>16 de Março</small></p>
                                    <p class="card-text texto_card_eventos m-0"><small>Parque das Nações, Lisboa</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-2 mt-4">
                        <div class="col align-content-center">
                            <div class="card card_eventos h-100">
                                <img src="imagens/evento1.jpeg" class="card-img-top" alt="...">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <p class="card-title mb-1 titulo_card_eventos col-10"><b>Encontro Nacional de
                                            Design</b></p>
                                        <img class="icone_categoria" src="imagens/icones/icone_festa.png">
                                    </div>
                                    <p class="card-text texto_card_eventos m-0"><small>16 de Março</small></p>
                                    <p class="card-text texto_card_eventos m-0"><small>Parque das Nações, Lisboa</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


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
               href="pesquisa.html">
                <i class="fas fa-2x fa-search"></i>
                <br/>
                <span class="texto-nav">PESQUISA</span>
            </a>
            <a class="col-3  justify-content-center text-center" id="adicionar"
               href="meu_perfil.php">
                <i class="fas fa-2x fa-plus-circle"></i>
                <br/>
                <span class="texto-nav">ADICIONAR</span>
            </a>
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
