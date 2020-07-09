<?php
session_start();

if (isset($_SESSION['id_utilizador'])){

    $id_utilizador = $_SESSION['id_utilizador'];

}

if (isset($_POST['evento'])){
    $id_evento = $_POST['evento'];
}

if (isset($_GET['idp'])){

$id_pub = $_GET['idp'];

}

if (isset($_GET['message'])){
    $feedback = $_GET['message'];
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
    <script src="../node_modules/exif-js/exif.js"></script>

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

    <form enctype="multipart/form-data" action="carregarconteudo3.php?idp=<?=$id_pub?>" id="formulario" role="form" method="post">

        <div class="stepper_passo2">
            <div id="stepProgressBar">
                <div class="step" id="step1">
                    <p class="step-text"></p>
                    <div class="bullet">1</div>
                </div>

                <div class="step" id="step2">
                    <p class="step-text"></p>
                    <div class="bullet passo_atual">2</div>
                </div>

                <div class="step" id="step3">
                    <p class="step-text"></p>
                    <div class="bullet">3</div>
                </div>
            </div>
        </div>


        <div class="conteudo_stepper">
            <div class="field w-75 mx-auto stepper">

                <div class="title mt-4 label">Carrega o teu conteúdo.</div>

                <?php
                if (isset($_GET['idp'])) {


                    require_once "../admin/connections/connection2db.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT conteudo_publicacao
                      FROM   publicacoes
                      WHERE id_publicacao = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $id);

                        $id = $id_pub;
                        if (mysqli_stmt_execute($stmt)) {

                            mysqli_stmt_bind_result($stmt, $imagem);

                            if (mysqli_stmt_fetch($stmt)) {
                                ?>
                                <div class="afteruploads mt-2 mb-2">
                                    <a data-toggle="modal" data-target="#fotografiaModal">
                                        <p style="padding-top: 7%; text-align: initial;">
                                            <img id='imagem_nova' class="imagem_carregamento"
                                                 src="scripts/upload/<?= $imagem ?>">
                                            <input value="" id="data_real" type="hidden" name="data_real">
                                        </p>
                                    </a>
                                </div>

                                <?php

                            }
                        }
                    }

                } else {
                    ?>
                    <div class="uploads mt-2 mb-2">
                        <a data-toggle="modal" data-target="#fotografiaModal">
                            <p style="padding-top: 7%;"><i class="fas fa-camera"
                                                           style="font-size: font-size: 30px;"></i></p>
                        </a>
                    </div>
                    <?php
                    if (isset($feedback)) {
                        ?>
                        <p><?= $feedback ?></p>
                        <?php
                    }

                }
                ?>
                <div class="field" style="margin-top: 14vh">
                    <div class="label">Descrição da publicação.</div>
                    <input type="text" name="descricao" value="" placeholder="Escreve uma pequena descrição ..."
                           class="campo_form p-2 w-100">
                </div>
            </div>
        </div>


        <div class="fixed-bottom mb-3 botoes_stepper">
            <?php
            if (isset($imagem)) {
                ?>
                <a href="carregarconteudo1.php?<?= $id_evento ?>&img=<?= $imagem ?>">
                    <button class="button_stepper" id="previousBtn">Anterior</button>
                </a>
                <?php
            } else {
                ?>
                <a href="carregarconteudo1.php?<?= $id_evento ?>">
                    <button class="button_stepper" id="previousBtn">Anterior</button>
                </a>
                <?php
            }
            ?>

            <button class="button_stepper" type="submit" id="nextBtn">Seguinte</button>
            <button class="button_stepper" id="finishBtn" disabled>Confirmar</button>
        </div>

    </form>

    <div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos"
         aria-hidden="true" style="margin-top: 35vh">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modalupload">
                    <form action="scripts/upload_conteudos.php?id=<?= $id_evento ?>" method="post"
                          enctype="multipart/form-data" class="formularioupload">
                        <p>Seleciona um ficheiro e clica em upload</p>
                        <input type="file" name="file" style="font-size: 12px;padding-bottom: 20px;">
                        <input type="submit" name="submit" value="Upload" class="socorro">
                    </form>
                </div>
            </div>

        </div>

    </div>


</main>
<script>
    <?php if (isset($imagem)){
    ?>

    window.onload = getExif;

    function getExif() {
        var img = document.getElementById("imagem_nova");
        EXIF.getData(img, function () {
            var data_imagem = EXIF.getTag(this, "DateTime");
            document.getElementById("data_real").value = data_imagem;
            console.log(data_imagem);

        });
        /*
                EXIF.getData(img1, function() {
                    var loc = EXIF.getTag(this, "GPSLatitude");
                    document.getElementById("makeAndModel1").innerHTML = loc;

                    var loc_l = EXIF.getTag(this, "GPSLongitudeRef");
                    document.getElementById("makeAndModel1").innerHTML += '  ' + loc_l;

                    ParseDMS(parseInt(loc_l));

                    function ParseDMS(input) {
                        var parts = input.split(/[^\d\w]+/);
                        var lat = ConvertDMSToDD(parts[0], parts[1], parts[2], parts[3]);
                        // var lng = ConvertDMSToDD(parts[4], parts[5], parts[6], parts[7]);
                        console.log(lat);
                        // console.log(lng);
                    }
                });*/
    }
    <?php
    } ?>

    //  dd = d + m/60 + s/3600


</script>


</body>
</html>