<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['id_utilizador'])){

    $id_evento = $_GET['id'];
    $id_utilizador = $_SESSION['id_utilizador'];

}


//aqui escolhem a pasta para onde vai o ficheiro
$target_dir = "http://360.web.ua.pt/public/scripts/upload/";

//aqui fazem a concatenaÁ„o do diretorio com o nome do ficheiro
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$target_file = $target_dir . uniqid() . "." . $imageFileType;

$message = 10;
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $message = 1;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    var_dump("existe erro");

    $message = 2;
}
// Check file size
if ($_FILES["file"]["size"] > 200000000000) {
    $msgerro = 1;
    var_dump("deu errosize");

    $uploadOk = 0;
    $message = 3;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    var_dump("deu erro jpg");

    $msgerro = 2;
    $uploadOk = 0;
    $message = 4;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message = 5;
    var_dump("deu erro");

// if everything is ok, try to upload file
} else {
    var_dump(basename($_FILES["file"]["name"]));

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir)) {
        echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
        $nomedapic = $_FILES["file"]["name"];
        $uploadedImagePath = $target_file;

        $msgerro = 4;
    } else {
        echo "Sorry, there was an error uploading your file.";
        $msgerro = 3;
    }
}



require_once "../../admin/connections/connection2db.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE utilizador SET profile_pic = ? WHERE id_utilizador LIKE ?";

if (isset($id_evento)) {
// Insert image file name into database
    $query = "INSERT INTO publicacoes (eventos_id_evento, conteudo_publicacao, data_publicacao)     
                          VALUES ( ? ,?, NOW())";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'is', $id, $imagem);

        $id = $id_evento;
        $imagem = $target_file;
        if (mysqli_stmt_execute($stmt)) {

            if (mysqli_stmt_fetch($stmt)) {

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

        }
    }
}




?>



