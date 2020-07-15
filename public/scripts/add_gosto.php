<?php
session_start();

if (isset($_GET['idp']) && isset($_SESSION['id_utilizador'])){

    //recebe id
    $id_publicacao = $_GET['idp'];
    $id_utilizador = $_SESSION['id_utilizador'];


    require_once "../../admin/connections/connection2db.php";

    //verifica se a publicacao tem gosto
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT gosto
              FROM utilizadores_has_publicacoes
              WHERE utilizadores_id_utilizador = ? AND publicacoes_id_publicacao = ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_user,$id_pub);

        $id_user = $id_utilizador;
        $id_pub = $id_publicacao;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $gosto);

        if (mysqli_stmt_fetch($stmt)) {

            if ($gosto === 1) {
                    //altera para nao gosto
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "UPDATE utilizadores_has_publicacoes 
                              SET gosto  = 0 
                              WHERE utilizadores_id_utilizador = ? AND publicacoes_id_publicacao = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_pub);

                        $id_user = $id_utilizador;
                        $id_pub = $id_publicacao;
                        if (mysqli_stmt_execute($stmt)) {

                            header("Location: ../publicacao.php?idp=$id_publicacao");
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);

                        } else {

                            echo "Error:" . mysqli_stmt_error($stmt);
                            header("Location: ../index.php?msg=0#login");
                        }
                    }
            } else{


                //altera para gosto
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "UPDATE utilizadores_has_publicacoes
                              SET gosto  = 1 
                              WHERE utilizadores_id_utilizador = ? AND publicacoes_id_publicacao = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_pub);

                    $id_user = $id_utilizador;
                    $id_pub = $id_publicacao;
                    if (mysqli_stmt_execute($stmt)) {

                        header("Location: ../publicacao.php?idp=$id_publicacao");

                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                    } else {

                        echo "Error:" . mysqli_stmt_error($stmt);
                        header("Location: ../index.php?msg=0#login");
                    }
                }



            }


        }
    }







}


