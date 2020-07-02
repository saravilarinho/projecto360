<?php
session_start();


if (isset($_SESSION['id_utilizador']) && isset($_POST['nome_evento']) && isset($_POST['descricao']) && isset($_POST['localizacao']) &&
isset($_POST['data_inicio']) && isset($_POST['hora_inicio']) && isset($_POST['data_fim']) && isset($_POST['hora_fim'])
    && isset($_POST['generoevento']) && isset($_POST['gender']) && (isset($_POST['lat'])) && (isset($_POST['lng']))) {

    $nova = $_POST['convidado1'];
    $latitude_int = $_POST['lat'];
    $longitude_int = $_POST['lng'];
    settype ( $latitude_int, "int");
    settype($longitude_int, "int");

    require_once "../../admin/connections/connection2db.php";

    //inserir evento na tabela de eventos
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO eventos (nome_evento, data_inicio_evento, hora_inicio, data_fim_evento, hora_fim, localizacao_evento, 
descricao_evento, categorias_id_categoria, niveis_privacidade_id_nivel_privacidade, coor_lat, coor_long) 
VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssiiii', $nome_evento, $data_inicio, $hora_inicio, $data_fim,
            $hora_fim, $localizacao, $descricao, $categoria, $privacidade, $latitude, $longitude);

        $id_utilizador = $_SESSION['id_utilizador'];
        $nome_evento = $_POST['nome_evento'];
        $descricao = $_POST['descricao'];
        $localizacao = $_POST['localizacao'];
        $data_inicio = $_POST['data_inicio'];
        $hora_inicio = $_POST['hora_inicio'];
        $data_fim = $_POST['data_fim'];
        $hora_fim = $_POST['hora_fim'];
        $categoria = $_POST['generoevento'];
        $privacidade = $_POST['gender'];

        $latitude = $latitude_int;
        $longitude = $longitude_int;


        if (mysqli_stmt_execute($stmt)) {
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT id_evento
                      FROM   eventos
                      ORDER  BY id_evento DESC
                      LIMIT  1;";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id);

                if (mysqli_stmt_fetch($stmt)) {

                    $evento = $id;

                    //inserir relaçao de criador na tabela utilizadores_has_eventos
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "INSERT INTO utilizadores_has_eventos (utilizadores_id_utilizador, eventos_id_evento, data, roles_id_role, convidados)
                              VALUES (?,?, NOW() ,? , ?)";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'iiis', $id_utilizador, $id_evento, $role, $lista_convidados);

                        $id_utilizador = $_SESSION['id_utilizador'];
                        $id_evento = $evento;
                        $role = 1;
                        $lista_convidados = $nova;

                        if (mysqli_stmt_execute($stmt)) {

                          header("Location: sendemail.php?id=$id_evento&&nome=$nome_evento&&lista=$nova");
                           // header("Location: ../eventocomsubscricao.php?id=$id_evento");
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                        }
                    } else {

                        echo "Error:" . mysqli_stmt_error($stmt);
                         header("Location: ../login.php?msg=0#login");
                    }

                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);
            }


        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../login.php?msg=0#login");
            }
    }

    else {
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
}