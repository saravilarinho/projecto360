<?php
session_start();

if (isset($_SESSION['id_utilizador'])){

    $id_utilizador = $_SESSION['id_utilizador'];

}

?>
<!DOCTYPE html>
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

    <form  enctype="multipart/form-data" action="scripts/nova_publicacao.php" id="formulario" role="form" method="post">

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
                              WHERE utilizadores_has_eventos.utilizadores_id_utilizador = $id_utilizador AND data_fim_evento >= NOW()";

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
                    <form action="scripts/upload_conteudos.php?id=<?php echo $idd?>" method="post" enctype="multipart/form-data" class="formularioupload">
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

        <?php
            if (isset($_GET['a'])){
                ?>
        document.getElementById("toggle1").style.display = "none";
        document.getElementById("toggle2").style.display = "none";
        document.getElementById("toggle2").style.visibility = "hidden";
        document.getElementById("toggle3").style.display = "block";
        document.getElementById("toggle3").style.visibility = "visible";
        <?php

            }
        ?>
        if (currentStep === 1 ){
            getRadioVal(document.getElementById('formulario'),'evento');
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
        console.log(val);

        <?php
            $idd = 'val'
        ?>

       window.location.href = "carregar1.php?id=" + val
    }


</script>
</body>
</html>