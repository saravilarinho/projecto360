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

    $query = "SELECT favorito
              FROM utilizadores_has_eventos 
              WHERE utilizadores_id_utilizador = ? AND eventos_id_evento = ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_user,$id_evento);

        $id_user = $id_utilizador;
        $id_evento = $id;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $favorito);

        if (mysqli_stmt_fetch($stmt)) {

            switch ($favorito) {

                //se já está favoritado, desfavorita
                case 1:

                    var_dump("esta favoritado, desfavorita");
                    //altera para nao favoritado
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "UPDATE utilizadores_has_eventos 
                              SET favorito  = 0 
                              WHERE utilizadores_id_utilizador = ? AND eventos_id_evento = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_evento);

                        $id_user = $id_utilizador;
                        $id_evento = $id;
                        if (mysqli_stmt_execute($stmt)) {


                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                            header("Location: ../eventocomsubscricao.php?id=$id");
                        } else {

                            echo "Error:" . mysqli_stmt_error($stmt);
                            header("Location: ../index.php?msg=0#login");
                        }
                    }



                    break;

                default:

                    //altera para favoritado
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "UPDATE utilizadores_has_eventos 
                              SET favorito  = 1 
                              WHERE utilizadores_id_utilizador = ? AND eventos_id_evento = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_evento);

                        $id_user = $id_utilizador;
                        $id_evento = $id;
                        if (mysqli_stmt_execute($stmt)) {


                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                            header("Location: ../eventocomsubscricao.php?id=$id");
                        } else {

                            echo "Error:" . mysqli_stmt_error($stmt);
                            header("Location: ../index.php?msg=0#login");
                        }
                    }
            }


        }
    }


}