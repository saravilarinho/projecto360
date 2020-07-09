<?php
session_start();

require_once "../../admin/connections/connection2db.php";

if(isset($_GET["id"]) && isset($_SESSION['id_utilizador'])) {

    //recebe id
    $id = $_GET["id"];
    $id_utilizador = $_SESSION['id_utilizador'];


    //verifica privacidade do evento
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT niveis_privacidade_id_nivel_privacidade
              FROM eventos
              WHERE id_evento = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_evento);

        $id_evento = $id;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_privacidade);

        if (mysqli_stmt_fetch($stmt)) {

            switch ($id_privacidade) {

                //publico
                case 1:
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
                            header("Location: update_estatisticas.php?id=$id&subscricao=1");
                        } else {

                            echo "Error:" . mysqli_stmt_error($stmt);
                            header("Location: ../evento_semsubscricao.php?id=$id");
                        }
                    } else {
                        echo "Error:" . mysqli_error($link);
                        mysqli_close($link);
                    }

                    break;

                case 2:

                    //evento privado

                    header("Location: ../evento_semsubscricao.php?id=$id&&message=1");


            }

        }


        else {echo "Campos do formulário por preencher";}

            }


        }









?>