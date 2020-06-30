<?php
session_start();

if (isset($_GET['id']) && isset($_GET['lista']) && isset($_GET['nome']) && isset($_SESSION['id_utilizador'])) {

$lista_convidados = $_GET['lista'];
// pass delimiter and string to explode function
    $lista_array = explode(', ', $lista_convidados);

    $id_evento = $_GET['id'];
    $nome_evento = $_GET['nome'];
    $id_utilizador = $_SESSION['id_utilizador'];

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
            $mail->isSMTP();
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
?>