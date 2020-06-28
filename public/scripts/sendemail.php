<?php

require_once ('../../admin/PHPMailer/PHPMailerAutoload.php');

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
$mail->Subject = 'teste';
$mail->Body = 'teste';
$mail->AddAddress('vilarinho.sara7@gmail.com');


$mail->Send();
?>