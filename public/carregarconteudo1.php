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

    <form enctype="multipart/form-data" action="carregarconteudo2.php" id="formulario" role="form" method="post">

        <div class="stepper">
            <div id="stepProgressBar">
                <div class="step" id="step1">
                    <p class="step-text"></p>
                    <div class="bullet passo_atual">1</div>
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
        </div>



        <div class="conteudo_stepper ml-4">
                <div id="toggle1" class="stepper">
                    <div class="title mt-4">Escolhe o evento:</div>
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
                        </div>

                    </div>
                </div>
            </div>




        <div class="fixed-bottom mb-5 botoes_stepper">
            <button class="button_stepper" id="previousBtn" disabled>Anterior</button>

                <button class="button_stepper" type="submit" id="nextBtn">Seguinte</button>

            <button class="button_stepper" id="finishBtn" disabled>Confirmar</button>
        </div>
    </form>

</main>

</body>
</html>