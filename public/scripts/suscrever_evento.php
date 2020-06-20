<?php
session_start();

require_once "../../admin/connections/connection2db.php";

if(isset($_GET["id"]) && isset($_SESSION['id_utilizador'])) {

    //recebe id
    $id = $_GET["id"];
    $id_utilizador = $_SESSION['id_utilizador'];

    //insere relacao na base de dados
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores_has_eventos (utilizadores_id_utilizador, eventos_id_evento, roles_id_role) 
              VALUES (?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iii', $id_user, $id_evento, $id_role);

        $id_user = $id_utilizador;
        $id_evento = $id;
        $id_role = 2;

        if (mysqli_stmt_execute($stmt)) {


            mysqli_stmt_close($stmt);
            mysqli_close($link);
            header("Location: ../eventocomsubscricao.html?id=$id");
        }
        else {

            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../index.php?msg=0#login");
        }
    }

    else {
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
}

else {
    echo "Campos do formulário por preencher";
}
?>