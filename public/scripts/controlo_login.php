<?php


require_once "../../admin/connections/connection2db.php";


if(isset ($_POST["email"]) && (isset ($_POST["password"]))){

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password, id_utilizador 
              FROM utilizadores 
              WHERE email LIKE ?";


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email);

        $email = $_POST["email"];
        $password = $_POST["password"];


        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash, $id_utilizador);

            if (mysqli_stmt_fetch($stmt)) {

                if (password_verify($password, $password_hash)) {


                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['id_utilizador'] = $id_utilizador;


                    // Feedback de sucesso
                    header("Location: ../feed.php?x=1&y=$id_utilizador");
                }
                else {
                    // password errada ou user nao tem acesso
                   header("Location: ../login.php?message=1");

                }
            }
            else {
                // Username não existe
                header("Location: ../login.php?message=2");
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
}

else {

   header("Location: ../login.php?message=3");
}

?>