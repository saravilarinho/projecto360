<?php
session_start();
if(isset($_GET["id"]) && isset($_SESSION['id_utilizador'])){

    //recebe id
    $id = $_GET["id"];
    $id_utilizador = $_SESSION['id_utilizador'];

    //verifica se ha relacao na base de dados com o evento

    require_once "../../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT utilizadores_has_eventos.utilizadores_id_utilizador, 
              utilizadores_has_eventos.eventos_id_evento, utilizadores_has_eventos.roles_id_role
              FROM `utilizadores_has_eventos`
              WHERE utilizadores_id_utilizador = ? AND eventos_id_evento = ?";


        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ii', $id_utilizador, $id);

            $id_utilizador = $_SESSION['id_utilizador'];
            $id = $_GET["id"];

            var_dump("este é o evento:" . $id);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $id_utilizador,  $id, $role);

            // o user já tem relacao com o evento

            if (mysqli_stmt_fetch($stmt)) {

                switch ($role){
                    case 1:
                        //criou evento
                            header("Location: ../eventocomsubscricao.php?id=$id&&role=$role");
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);

                            break;

                    case 2:
                        // está subscrito
                        header("Location: ../eventocomsubscricao.php?id=$id");
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);

                        break;


                    case 3:
                        // foi convidado
                        header("Location: ../eventocomsubscricao.php?id=$id");
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);

                        break;


                    default:
                        //o evento não está subscrito

                        $id = $_GET["id"];

                     header("Location: ../evento_semsubscricao.php?id=$id");
                }
                }
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            }
}

else {

    //redireciona para login com mensagem para reuniciar sessão
    header("Location: ../login.php?message=2");
}

?>