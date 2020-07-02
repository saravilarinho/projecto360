<?php
session_start();

if (isset($_GET['id']) && isset($_GET['lista']) && isset($_GET['nome']) && isset($_SESSION['id_utilizador'])) {

    $lista_convidados = $_GET['lista'];
    // pass delimiter and string to explode function
    $lista_array = explode(', ', $lista_convidados);

    $id_evento = $_GET['id'];
    $nome_evento = $_GET['nome'];
    $id_utilizador = $_SESSION['id_utilizador'];

    var_dump($lista_array);

    require_once "../../admin/connections/connection2db.php";


    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT nome_utilizador
              FROM   utilizadores
              WHERE id_utilizador = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);

        $id_user = $id_utilizador;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome_utilizador);

        if (mysqli_stmt_fetch($stmt)) {


            require_once('../../admin/PHPMailer/PHPMailerAutoload.php');

            $mail = new PHPMailer();
           // $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = 'projeto360ua2020@gmail.com';
            $mail->Password = 'Projecto360%';
            $mail->SetFrom('no-reply@gmail.com');
            $mail->Subject = 'Convite para o evento ' . $nome_evento;
            $mail->Body = '<p>Foste convidado por ' . $nome_utilizador . ' para o evento ' . $nome_evento . ', para saberes mais, acede à aplicação 360 e subscreve o evento!</p>
       <br>
       <a href="http://360.web.ua.pt/projecto360/public/login.php">Projeto 360 </a>';

            foreach($lista_array as $value => $key)
            {
                $mail->AddAddress($key);
            }

            $mail->Send();

            header("Location: ../eventocomsubscricao.php?id=$id_evento");

        }

    }
    }

if (isset($_GET['idp']) && isset($_GET['lista']) && isset($_SESSION['id_utilizador'])) {


    $lista_convidados = $_GET['lista'];
    // pass delimiter and string to explode function
    $lista_array = explode(', ', $lista_convidados);

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_publicacao = $_GET['idp'];

    require_once "../../admin/connections/connection2db.php";


    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT nome_utilizador
              FROM   utilizadores
              WHERE id_utilizador = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);

        $id_user = $id_utilizador;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome_utilizador);

        if (mysqli_stmt_fetch($stmt)) {

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT nome_evento
              FROM   eventos
              INNER JOIN publicacoes
              ON eventos.id_evento = publicacoes.eventos_id_evento 
              WHERE publicacoes.id_publicacao = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'i', $id_p);

                $id_p = $id_publicacao;

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $nome_evento_publicacao);

                if (mysqli_stmt_fetch($stmt)) {
                    require_once('../../admin/PHPMailer/PHPMailerAutoload.php');
                    require_once ('../../admin/PHPMailer/class.phpmailer.php');

                    $mail = new PHPMailer();
                  //  $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = '465';
                    $mail->isHTML();
                    $mail->Username = 'projeto360ua2020@gmail.com';
                    $mail->Password = 'Projecto360%';
                    $mail->SetFrom('no-reply@gmail.com');
                    $mail->Subject = 'Foste identificado numapublicação ' . $nome_utilizador;
                    $mail->Body = '<p>Foste identificado por ' . $nome_utilizador . ' numa publicação do evento ' . $nome_evento_publicacao . ', para saberes mais, acede à aplicação 360 e subscreve o evento!</p>
       <br>
       <a href="http://360.web.ua.pt/projecto360/public/login.php">Projeto 360 </a>';

                    foreach($lista_array as $value => $key)
                    {
                        $mail->AddAddress($key);
                    }

                    $mail->Send();


                    header("Location: ../publicacao.php?idp=$id_p");

                }
            }

        }

    }





}



?>