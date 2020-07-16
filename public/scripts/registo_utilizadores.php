<?php
require_once "../../admin/connections/connection2db.php";

if(isset($_POST['email'])) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT email
          FROM utilizadores
          WHERE email = ?";


    if(mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        $email = $_POST["email"];

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $email);


        if (mysqli_stmt_fetch($stmt)) {

            header("Location: ../register.php?msg=0");
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        else {

            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password_hash']) && isset($_POST['password_hash1'])) {

                if($_POST['password_hash'] != ""){

                    if ($_POST['password_hash'] === $_POST['password_hash1']){

                        $link = new_db_connection();

                        $stmt = mysqli_stmt_init($link);

                        $query = "INSERT INTO utilizadores (nome_utilizador, password, email) VALUES (?,?,?)";

                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_bind_param($stmt, 'sss', $nome,  $password_hash, $email);
                            $nome = $_POST['name'];
                            $password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
                            $email = $_POST['email'];

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_close($stmt);
                                mysqli_close($link);



                                header("Location: ../login.php?x=0");
                            }
                            else {

                                echo "Error:" . mysqli_stmt_error($stmt);

                                header("Location: ../register.php?msg=1");
                            }

                        } else {
                            echo "Error:" . mysqli_error($link);
                            mysqli_close($link);
                        }


                    }


                }
                else {

                    header("Location: ../register.php?msg=1");
                }


            }
            else {

                header("Location: ../register.php?msg=1");
            }

        }


    }

}
else{
    header("Location: ../register.php?msg=1");

}

