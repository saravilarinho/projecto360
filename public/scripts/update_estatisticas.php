<?php
session_start();
if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])  && isset($_GET['novoevento'])) {

    $id_utilizador = $_SESSION['id_utilizador'];

    $id_eventop = $_GET['id'];


    require_once "../../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT eventos.id_evento
          FROM eventos 
          INNER JOIN utilizadores_has_eventos 
          ON utilizadores_has_eventos.eventos_id_evento = eventos.id_evento 
          WHERE utilizadores_has_eventos.utilizadores_id_utilizador = ? 
          AND utilizadores_has_eventos.roles_id_role = 1
                               ";


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_utili);

        $id_utili = $id_utilizador;

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $id_evento);

        $numero_eventos_criados = 0;

        while (mysqli_stmt_fetch($stmt)) {

            $numero_eventos_criados++;

        }

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE utilizadores 
              SET eventos_criados = ?
              WHERE id_utilizador = $id_utilizador";


        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $numero_eventos);

            $numero_eventos = $numero_eventos_criados;

            if (mysqli_stmt_execute($stmt)) {

                header("Location: ../eventocomsubscricao.php?id=$id_eventop");

            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);

    }
}

if (isset($_SESSION['id_utilizador']) && isset($_GET['id']) && isset($_GET['subscricao'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_eventop = $_GET['id'];

    require_once "../../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT eventos.id_evento
              FROM eventos 
              INNER JOIN utilizadores_has_eventos 
              ON utilizadores_has_eventos.eventos_id_evento = eventos.id_evento 
              WHERE utilizadores_has_eventos.utilizadores_id_utilizador = ? 
              AND utilizadores_has_eventos.roles_id_role = 2
                               ";


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_utili);

        $id_utili = $id_utilizador;

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $id_evento);

        $numero_eventos_subs = 0;

        while (mysqli_stmt_fetch($stmt)) {

            $numero_eventos_subs++;

        }

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE utilizadores 
              SET eventos_subscritos = ?
              WHERE id_utilizador = $id_utilizador";


        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $numero_eventos_s);

            $numero_eventos_s = $numero_eventos_subs;

            if (mysqli_stmt_execute($stmt)) {

                header("Location: ../eventocomsubscricao.php?id=$id_eventop");


            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);

    }

}

if (isset($_SESSION['id_utilizador']) && isset($_GET['idp']) && isset($_GET['conteudos'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_pub = $_GET['idp'];


    require_once "../../admin/connections/connection2db.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT publicacoes.id_publicacao
              FROM publicacoes 
              INNER JOIN utilizadores_has_publicacoes
              ON utilizadores_has_publicacoes.publicacoes_id_publicacao = publicacoes.id_publicacao
              WHERE utilizadores_has_publicacoes.utilizadores_id_utilizador = ? 
               AND utilizadores_has_publicacoes.criacao_publicacao = 1
                               ";


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_utili);

        $id_utili = $id_utilizador;

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $id_p);

        $numero_pub = 0;

        while (mysqli_stmt_fetch($stmt)) {

            $numero_pub++;

        }

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE utilizadores 
                  SET conteudos_partilhados = ?
                  WHERE id_utilizador = $id_utilizador";


        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $numero_publica);

            $numero_publica = $numero_pub;

            if (mysqli_stmt_execute($stmt)) {

                header("Location: ../publicacao.php?idp=$id_pub");


            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);

    }

}