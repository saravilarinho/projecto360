<?php
session_start();


if (isset($_SESSION['id_utilizador']) && isset($_GET['id']) && isset($_POST['nomeevento']) && isset($_POST['descricao'])
    && isset($_POST['datainicio']) && isset($_POST['datafim']) && isset($_POST['localizacao']) && isset($_POST['horainicio'])
    && isset($_POST['horafim'])  ){

    require_once "../../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);



    $id_utilizador = $_SESSION['id_utilizador'];
    $id_ev = $_GET['id'];

    $nome_evento = $_POST['nomeevento'];
    $descricao =$_POST['descricao'];
    $data_i=$_POST['datainicio'];
    $hora_i =  $_POST['horainicio'];
    $data_f=$_POST['datafim'];
    $hora_f = $_POST['horafim'];
    $local=$_POST['localizacao'];

    $query = "UPDATE eventos 
              SET nome_evento  = ?, data_inicio_evento = ?, hora_inicio = ?, data_fim_evento = ?, hora_fim = ?, 
              localizacao_evento = ?, descricao_evento = ?
              WHERE id_evento = $id_ev";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssssss', $nome_evento, $data_i, $hora_i, $data_f, $hora_f, $local, $descricao);

        if (mysqli_stmt_execute($stmt)) {

            header("Location: ../eventocomsubscricao.php?id=<?=$id_ev?>");

            mysqli_stmt_close($stmt);
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);

    }
    else {
        echo "Error: " . mysqli_error($link);}

    mysqli_close($link);

    }

