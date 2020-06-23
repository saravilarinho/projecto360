<?php
session_start();


if (isset($_SESSION['id_utilizador']) && isset($_GET['id']) && isset($_POST['nomeevento']) && isset($_POST['descricao']) && isset($_POST['datainicio']) && isset($_POST['datafim']) && isset($_POST['localizacao'])){

    require_once "../../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_ev = $_GET['id'];

    $nome_evento = $_POST['nomeevento'];
    $descricao =$_POST['descricao'];
    $data_i=$_POST['datainicio'];
    $data_f=$_POST['datafim'];
    $local=$_POST['localizacao'];

    $query = "UPDATE eventos 
              SET nome_evento  = ?, data_inicio_evento = ?, data_fim_evento = ?, 
              localizacao_evento = ?, descricao_evento = ?
              WHERE id_evento = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssss', $nome_evento, $data_i, $data_f, $local, $descricao);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);

    }
    else {
        echo "Error: " . mysqli_error($link);}

    mysqli_close($link);

    header("Location: ../eventocomsubscricao.php?id=<?=$id_ev?>");
    }

