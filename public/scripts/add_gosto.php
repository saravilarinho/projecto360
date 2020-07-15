<?php
session_start();

if (isset($_GET['idp']) && isset($_SESSION['id_utilizador'])){

    //recebe id
    $id_publicacao = $_GET['idp'];
    $id_utilizador = $_SESSION['id_utilizador'];


    require_once "../../admin/connections/connection2db.php";
    //verifica se o utilizador tem relaçao com a publicacao

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT utilizadores_id_utilizador, publicacoes_id_publicacao
              FROM utilizadores_has_publicacoes
              WHERE utilizadores_id_utilizador = ? AND publicacoes_id_publicacao = ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id, $pub);

        $id = $id_utilizador;
        $pub = $id_publicacao;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_u, $id_p);

        if (mysqli_stmt_fetch($stmt)) {

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

                    var_dump($gosto);

                    if ($gosto === 1) {
                        //altera para nao gosto
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);

                        $query = "UPDATE utilizadores_has_publicacoes 
                              SET gosto  = 0 
                              WHERE utilizadores_id_utilizador = ? AND publicacoes_id_publicacao = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_pub);
                            var_dump("gentxi ");

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

                    if ($gosto === 0){

                        require_once "../../admin/connections/connection2db.php";

                        //altera para gosto
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        var_dump("oi gentxi");

                        $query = "UPDATE utilizadores_has_publicacoes
                              SET gosto  = 1 
                              WHERE utilizadores_id_utilizador = ? AND publicacoes_id_publicacao = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_pub);
                            var_dump("rrrrrr");

                            $id_user = $id_utilizador;
                            $id_pub = $id_publicacao;
                            if (mysqli_stmt_execute($stmt)) {

                                header("Location: ../publicacao.php?idp=$id_publicacao");

                                mysqli_stmt_close($stmt);
                                mysqli_close($link);
                            } else {

                                echo "Error:" . mysqli_stmt_error($stmt);
                            }
                        }



                    }


                }
            }




        }else {


            require_once "../../admin/connections/connection2db.php";

            //altera para gosto
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            var_dump("oi gentxi");

            $query = "INSERT INTO utilizadores_has_publicacoes (utilizadores_id_utilizador, publicacoes_id_publicacao, gosto)
                      VALUES (? ,?, ? )
                      ";



            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'iii', $id_user, $id_pub, $gos);

                $id_user = $id_utilizador;
                $id_pub = $id_publicacao;
                $gos = 1;

                if (mysqli_stmt_execute($stmt)) {

                    header("Location: ../publicacao.php?idp=$id_publicacao");

                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                } else {

                    echo "Error:" . mysqli_stmt_error($stmt);
                }
            }




        }
    }








}


