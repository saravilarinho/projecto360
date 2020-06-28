<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_POST['nome_evento']) && isset($_POST['descricao']) && isset($_POST['localizacao']) &&
    isset($_POST['data_inicio']) && isset($_POST['hora_inicio']) && isset($_POST['data_fim']) && isset($_POST['hora_fim'])
    && isset($_POST['generoevento']) && isset($_POST['gender'])) {


    }