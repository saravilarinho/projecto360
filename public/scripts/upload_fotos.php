<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['id_utilizador'])){
    $id_utilizador = $_SESSION['id_utilizador'];
    $id_evento = $_GET['id'];

}


//aqui escolhem a pasta para onde vai o ficheiro
$target_dir = "uploads_fotos/";

//aqui fazem a concatenaÁ„o do diretorio com o nome do ficheiro
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$target_file = $target_dir . uniqid() . "." . $imageFileType;

$message = 10;
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
    $message = 2;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 200000) {
    $msgerro = 1;

    $uploadOk = 0;
    $message = 3;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

    $msgerro = 2;
    $uploadOk = 0;
    $message = 4;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message = 5;

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        $nomedapic = $_FILES["fileToUpload"]["name"];
        $uploadedImagePath = $target_file;

        $msgerro = 4;
    } else {
        echo "Sorry, there was an error uploading your file.";
        $msgerro = 3;
    }
}



include_once "../../admin/connections/connection2db.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE eventos 
          SET imagem_evento = ? 
          WHERE id_evento LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'si', $imagem, $id);
    $imagem = $target_file;
    $id = $id_evento;

    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_fetch($stmt)) {
            echo "<script>alert('okay???? deu????')</script>";


        } else {
            echo "<script>alert('aiai')</script>";
        }
    }
}

header("Location: ../editar_evento.php?id=".$_GET['id']."&msg=".$msgerro."&nome=".$imagem."");


?>



