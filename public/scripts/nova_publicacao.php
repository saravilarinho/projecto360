<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['des']) && isset($_GET['idp'])) {

    $id_utilizador =$_SESSION['id_utilizador'];
    $descricao = $_GET['des'];
    $id_publicacao = $_GET['idp'];
    if (isset($_POST['emailsusers'])){
        $listausers = $_POST['emailsusers'];

    }

    require_once "../../admin/connections/connection2db.php";


         $link = new_db_connection();
         $stmt = mysqli_stmt_init($link);

         $query = "INSERT INTO utilizadores_has_publicacoes (utilizadores_id_utilizador, publicacoes_id_publicacao, criacao_publicacao)     
                          VALUES ( ? , ? , ?)";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'iii', $id_user, $id_pub, $criacao);

            $id_user = $id_utilizador;
            $id_pub = $id_publicacao;
            $criacao = 1;

            if (mysqli_stmt_execute($stmt)) {

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);


                $query = "UPDATE publicacoes 
                          SET descricao  = ?
                          WHERE id_publicacao = $id_pub";


                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 's', $descricao);

                    if (mysqli_stmt_execute($stmt)) {

                        if (isset($listausers)){
                            header("Location: sendemail.php?idp=$id_pub&lista=$listausers");
                        }
                        else {

                            header("Location: ../publicacao.html?idp=$id_pub");

                        }

                        mysqli_stmt_close($stmt);
                    }
                    else {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                    mysqli_stmt_close($stmt);
                }



            }


        }
    }