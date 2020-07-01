<?php

if (isset($_GET['id'])){

    $id_evento = $_GET['id'];
    
}



// Include the database configuration file
require_once "../../admin/connections/connection2db.php";

// File upload path
$targetDir = "http://360.web.ua.pt/projecto360/public/scripts/upload/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $_SERVER['DOCUMENT_ROOT'] . '/projecto360/public/scripts/upload/';

//$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats

    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            if (isset($id_evento)) {
                // Insert image file name into database
                $query = "INSERT INTO publicacoes (eventos_id_evento, conteudo_publicacao, data_publicacao)     
                          VALUES ( ? ,'" . $fileName . "', NOW())";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'i', $id);

                    $id = $id_evento;
                    if (mysqli_stmt_execute($stmt)) {

                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);

                        $query = "SELECT id_publicacao
                      FROM   publicacoes
                      ORDER  BY id_publicacao DESC
                      LIMIT  1;";

                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_publicacao);

                            if (mysqli_stmt_fetch($stmt)) {

                                $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                                header("Location: ../carregarconteudo2.php?id=$id_evento&idp=$id_publicacao");



                            }

                        }



                    }
                    $statusMsg = "File upload failed, please try again.";
                }
            }
            else {
                if (isset($_GET['x']) && isset($_SESSION['id_utilizador'])) {
                    $id_utilizador = $_SESSION['id_utilizador'];

                    $query = "UPDATE utilizadores
                              SET foto = '" . $fileName . "'
                              WHERE id_utilizador = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $id_user);

                        $id_user = $id_utilizador;
                        if (mysqli_stmt_execute($stmt)) {
                            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                          //  header("Location: ../carregar1.php?message=$statusMsg");

                        }
                    }
                }
            }

            $statusMsg = '';

        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}


?>