<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['idp']) && isset($_POST['comentario'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_publicacao = $_GET['idp'];



    require_once "../../admin/connections/connection2db.php";


    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO comentarios (comentario, data_comentario, publicacoes_id_publicacao, utilizadores_id_utilizador)
              VALUES (?, NOW(), ?, ?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sii', $comentario, $id_pub, $id_user);

        $id_user = $id_utilizador;
        $id_pub = $id_publicacao;
        $comentario = $_POST['comentario'];

        if (mysqli_stmt_execute($stmt)) {

            header("Location: ../publicacao.php?idp=$id_publicacao");

            mysqli_stmt_close($stmt);
            mysqli_close($link);

        }else{
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../login.php?message=2");
        }

    }else{
        echo "Error:" . mysqli_stmt_error($stmt);
        header("Location: ../login.php?message=2");
    }

} else{
    header("Location: login.php?message=2");
    }

?>