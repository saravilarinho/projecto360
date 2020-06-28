<?php

session_start();

if (isset($_SESSION['id_utilizador'])){

    $id_utilizador = $_SESSION['id_utilizador'];

}

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
    <title>Criar Evento</title>

</head>
<body>
<header>
    <h3>
        <a href="feed.php" style="text-decoration: none; color: #03bd03;">
            <i class="fas fa-chevron-left mr-2 ml-1"></i>
        </a>
        Criar Evento
    </h3>

</header>

<main>
    <form  enctype="multipart/form-data" action="scripts/novo_evento.php" role="form" method="post">
<div class="stepper">
    <div id="stepProgressBar">
        <div class="step" id="step1">
            <p class="step-text"></p>
            <div class="bullet">1</div>
        </div>

        <div class="step" id="step2">
            <p class="step-text"></p>
            <div class="bullet">2</div>
        </div>

        <div class="step"  id="step3">
            <p class="step-text"></p>
            <div class="bullet">3</div>
        </div>
    </div>


    <div id="toggle1">
        <div class="field">
            <div class="label mt-2">Nome do evento</div>
            <input type="text" name="nome_evento" class="campos_form_criarevento" placeholder="Nome do evento">
        </div>
        <div class="field">
            <div class="label">Descrição do evento</div>
            <input type="text" name="descricao" class="campos_form_criarevento campo_descricao" placeholder="Escreve uma pequena descrição do evento">
        </div>
        <div class="field">
            <div class="label">Localização</div>
            <input type="text" name="localizacao" class="campos_form_criarevento" value="">
        </div>
        <div class="field">
            <div class="label">Duração</div>
            <input type="date"  name="data_inicio"  class="campos_form_criarevento campo_data_hora">
            <input type="date"  name="data_fim"  class="campos_form_criarevento campo_data_hora">
            <input type="time"  name="hora_inicio"  class="campos_form_criarevento campo_data_hora">
            <input type="time"  name="hora_fim"  class="campos_form_criarevento campo_data_hora">
        </div>
    </div>



    <div id="toggle2">
        <div class="title mt-4">Seleciona as categorias do teu evento</div>
        <div class="field">
            <div class="label mt-2">Qual é o género de evento?</div>
            <div class="container">
                <div class="row radio">
                    <div class="col-3"><input type="radio" id="festa" name="generoevento" value="4"><br>
                        <label for="festa" class="label">Festa</label></div>

                    <div class="col-5">
                        <input type="radio" id="manifestacao" name="generoevento" value="2"><br>
                        <label for="manifestacao" class="label">Manifestação</label></div>

                    <div class="col-3">
                        <input type="radio" id="musica" name="generoevento" value="1">
                        <label for="musica" class="label">Música</label>
                    </div>
                </div>
                <br>


                <div class="row radio">

                    <div class="col-5">
                        <input type="radio" id="teatro" name="generoevento" value="3">
                        <br>
                        <label for="teatro" class="label">Teatro</label></div>
                    <div class="col-3"></div>
                </div>


            </div>

            <div class="field mt-3">
                <div class="label">Qual é a privacidade que queres dar ao teu evento?</div>
                <div class="row radio">
                    <div class="col-6">
                        <input type="radio" id="publico" name="gender" value="1"><br>
                        <label for="male" class="label">Público</label></div>
                    <div class="col-6">
                        <input type="radio" id="privado" name="gender" value="2"><br>
                        <label for="female" class="label">Privado</label></div>
                </div>
            </div>
        </div>
    </div>

    <div id="toggle3">
        <div class="title mt-4">Convida participantes!</div>
        <div class="field mt-2">
            <div class="label">Adiciona utilizadores <b>360</b> ao evento.</div>
            <input type="text" class="campos_form_criarevento">
        </div>
        <p class="label mb-2"><b>ou</b></p>
        <div class="field">
            <div class="label">Envia convite por email a utilizadores que ainda não estejam na <b>360</b>.</div>
            <input type="text" class="campos_form_criarevento">
        </div>
    </div>
    </form>
    <div class="container_stepper mt-5">

        <div id="main">
            <button class="button_stepper" id="previousBtn" type="button"  onclick="clicou_atras(currentStep);" disabled >Previous</button>
            <button class="button_stepper" id="nextBtn" type="button" onclick="clicou(currentStep)">Next</button>
            <button class="button_stepper" id="finishBtn"  disabled>Finish</button>
        </div>
    </div>


</div>
</main>


<script src="interacoes_stepper2.js"></script>

<script>

    function clicou(currentStep) {
        if (currentStep === 1 ){
            console.log(" este é o passo 1");
            console.log(currentStep);
            document.getElementById("toggle1").style.display = "none";
            document.getElementById("toggle2").style.display = "block";
            document.getElementById("toggle2").style.visibility = "visible";
            document.getElementById("toggle3").style.display = "none";
        }
        if (currentStep === 2 ) {
            console.log(" este é o passo 2");
            console.log(currentStep);
            document.getElementById("toggle1").style.display = "none";
            document.getElementById("toggle2").style.display = "none";
            document.getElementById("toggle2").style.visibility = "hidden";
            document.getElementById("toggle3").style.display = "block";
            document.getElementById("toggle3").style.visibility = "visible";
        }
        if (currentStep === 3) {
            console.log(" este é o passo 3");
            console.log(currentStep);
            document.getElementById("toggle1").style.display = "none";
            document.getElementById("toggle2").style.display = "block";
            document.getElementById("toggle2").style.visibility = "visible";
            document.getElementById("toggle3").style.display = "none";
            document.getElementById("toggle3").style.visibility = "hidden";
        }
    }

    function clicou_atras(currentStep){
        currentStep = currentStep - 1;
        if (currentStep === 1 ){
            document.getElementById("toggle1").style.display = "block";
            document.getElementById("toggle2").style.display = "none";
            document.getElementById("toggle2").style.visibility = "hidden";
            document.getElementById("toggle3").style.display = "none";
        }

        if (currentStep === 2 ){
            document.getElementById("toggle1").style.display = "none";
            document.getElementById("toggle2").style.display = "block";
            document.getElementById("toggle2").style.visibility = "visible";
            document.getElementById("toggle3").style.display = "none";
        }
    }



</script>
</body>
</html>