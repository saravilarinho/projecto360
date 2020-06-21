<?php
session_start();


if(isset($_GET["id"]) && isset($_SESSION['id_utilizador'])) {

    //recebe id
    $id = $_GET["id"];
    $id_utilizador = $_SESSION['id_utilizador'];

    require_once "../../admin/connections/connection2db.php";

    //verifica se o evento está favoritado
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT roles_id_role
              FROM utilizadores_has_eventos 
              WHERE utilizadores_id_utilizador = ? AND eventos_id_evento = ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_user,$id_evento);

        $id_user = $id_utilizador;
        $id_evento = $id;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_role);

        if (mysqli_stmt_fetch($stmt)) {

            switch ($id_role) {

                //se já está favoritado desfavorita
                case 4:

                    break;

                default:

                    //insere relacao na base de dados
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "INSERT INTO utilizadores_has_eventos (utilizadores_id_utilizador, eventos_id_evento, roles_id_role) 
                              VALUES (?,?,?)";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'iii', $id_user, $id_evento, $id_role);

                        $id_user = $id_utilizador;
                        $id_evento = $id;
                        $id_role = 4;

                        if (mysqli_stmt_execute($stmt)) {


                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                            header("Location: ../eventocomsubscricao.php?id=$id&&message=3");
                        } else {

                            echo "Error:" . mysqli_stmt_error($stmt);
                          //  header("Location: ../index.php?msg=0#login");
                        }
                    }
            }


        }
    }


}