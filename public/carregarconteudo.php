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
    <title>Carregar Conteúdo</title>

</head>
<body>
<header>
    <h3>
        <a href="feed.php" style="text-decoration: none; color: #03bd03;">
            <i class="fas fa-chevron-left mr-2 ml-1"></i>
        </a>
        Carregar Conteúdo
    </h3>

</header>

<main>

    <form  enctype="multipart/form-data" action="scripts/nova_publicacao.php" id="formu" role="form" method="post">

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

            <div class="step" id="step3">
                <p class="step-text"></p>
                <div class="bullet">3</div>
            </div>
        </div>


        <div id="toggle1">
            <div class="label mt-4">Escolhe o evento:</div>
            <div class="field">
                <div class="container">
                    <?php
                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_evento, nome_evento
              FROM eventos
              INNER JOIN utilizadores_has_eventos
              ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento           
              WHERE utilizadores_has_eventos.utilizadores_id_utilizador = $id_utilizador ";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id, $nome);


                    while (mysqli_stmt_fetch($stmt)) {
                    ?>

                    <input type="radio" id="concerto1" name="evento" value="<?=$id?>">
                    <label for="concerto1" class="label"><?=$nome?></label> <br>

                        <?php
                    }
                    }
                    ?>
                    <input type="radio" id="outro" name="evento0" value="outro">
                    <label for="outro" class="label">Outro...</label>
                </div>


            </div>
        </div>



        <div id="toggle2">

            <div class="field">
                <div class="label">Carrega o teu conteúdo.</div>
                <div class="uploads mt-2" style="background-color: #4E6969; width: auto; height: 10vh; border-radius: 10px;
             ; text-align: center; color: white;opacity: 65%;">
                    <a data-toggle="modal" data-target="#fotografiaModal" onclick="getRadioVal(document.getElementById('formu'),'evento')">

                        <p style="padding-top: 7%;"><i class="fas fa-camera" style="font-size: font-size: 30px;"></i></p>
                    </a>

                </div>
            </div>
            <div class="field mt-4">
                <div class="label">Descrição da publicação.</div>
                <input type="text" class="campos_form_criarevento campo_descricao">

            </div>
        </div>


    <div id="toggle3">
        <div class="title mt-4">Identifica participantes!</div>
        <div class="field mt-2">
            <div class="label">Identifica utilizadores <b>360</b> ao evento.</div>
            <input type="text" class="campos_form_criarevento">
        </div>
        <p class="label mb-2"><b>ou</b></p>
        <div class="field">
            <div class="label">Notifica por email a utilizadores que ainda não estejam na <b>360</b>.</div>
            <input type="text" class="campos_form_criarevento">
        </div>
    </div>
    </div>

    </form>

    <div class="container_stepper">

        <div id="main">
            <button class="button_stepper" id="previousBtn" onclick="clicou_atras(currentStep);" disabled>Anterior</button>
            <button class="button_stepper" id="nextBtn" onclick="clicou(currentStep)">Seguinte</button>
            <button class="button_stepper" id="finishBtn" disabled>Confirmar</button>
        </div>


    </div>

    <div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos" aria-hidden="true" style="margin-top: 50%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modalupload">
                    <form action="scripts/upload_conteudos.php?id=<?=$_POST['evento']?>" method="post" enctype="multipart/form-data" class="formularioupload">
                        <p>Seleciona um ficheiro e clica em upload</p>
                        <input type="file" name="file" style="font-size: 12px;padding-bottom: 20px;">
                        <input type="submit" name="submit" value="Upload" class="socorro">
                    </form>
                </div>
            </div>

        </div>

    </div>


</main>

<script src="interacoes_stepper2.js"></script>

<script>

    function clicou(currentStep) {
        if (currentStep === 1 ){

            document.getElementById("toggle1").style.display = "none";
            document.getElementById("toggle2").style.display = "block";
            document.getElementById("toggle2").style.visibility = "visible";
            document.getElementById("toggle3").style.display = "none";
        }
        if (currentStep === 2 ) {

            document.getElementById("toggle1").style.display = "none";
            document.getElementById("toggle2").style.display = "none";
            document.getElementById("toggle2").style.visibility = "hidden";
            document.getElementById("toggle3").style.display = "block";
            document.getElementById("toggle3").style.visibility = "visible";
        }
        if (currentStep === 3) {

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


    function getRadioVal(form, name) {
        var val;

        // get list of radio buttons with specified name
        var radios = form.elements[name];

        // loop through list of radio buttons
        for (var i=0, len=radios.length; i<len; i++) {
            if ( radios[i].checked ) { // radio checked?
                val = radios[i].value; // if so, hold its value in val
                break; // and break out of for loop
            }
        }

        return val; // return value of checked radio or undefined if none checked

    }


</script>
</body>
</html>