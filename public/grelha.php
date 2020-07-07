


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

    <title>GRElha</title>

</head>



<style>

    .imagem_grelha_1_1 {
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .imagem_grelha_1_2 {
        background-image: url("imagens/evento2.jpeg");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .imagem_grelha_1_3 {
        background-image: url("imagens/evento1.jpeg");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .imagem_grelha_2_1 {
        background-image: url("imagens/evento1.jpeg");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .imagem_grelha_2_2 {
        background-image: url("imagens/evento2.jpeg");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .imagem_grelha_2_3 {
        background-image: url("imagens/evento1.jpeg");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }


</style>

<body>



<div class="container">
    <div class="row justify-content-center mb-2">



        <?php

        require_once "../admin/connections/connection2db.php";

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT conteudo_publicacao
                  FROM publicacoes
                  WHERE eventos_id_evento = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_evento);

        $id_evento = 3;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$imagem);


        while (mysqli_stmt_fetch($stmt)) {
        ?>
    <div class="col-3 mr-2" style="height: 90px">
        <span class="col-3 imagem_grelha_1_1 mr-2" style="background-image: url('scripts/upload/<?=$imagem?>'">

        </span>
    </div> <?php
            }}
            ?>
    </div>

    <div class="row justify-content-center" style="height: 90px">
        <div class="col-3 imagem_grelha_2_1 mr-2">
        </div>
        <div class="col-3 imagem_grelha_2_2 mr-2">
        </div>
        <div class="col-3 imagem_grelha_2_3">
        </div>
    </div>




</div>




</body>
</html>