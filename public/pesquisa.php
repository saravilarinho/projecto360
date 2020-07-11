<?php
session_start();


if (isset($_SESSION['id_utilizador'])) {
    $id_utilizador = $_SESSION['id_utilizador'] ;
}else{
    header("Location: login.php?message=2");

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- JS, Popper.js, and jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500&display=swap" rel="stylesheet">

    <!-- Ligacoes -->
    <script type="javascript" src="interacoes.js" ></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>

    <title>Pesquisa</title>

</head>


<body>

<header>
    <h3>
        Pesquisa
    </h3>
</header>



<main>


    <form class="form-horizontal pesquisa mt-4" action="/action_page.php">
        <div class="form-group">
            <div class="col-sm-10">
                <input type="text" class="form-control campo_form" id="form_pesquisa" placeholder="Pesquisa aqui o evento que procuras">
            </div>
        </div>
    </form>

    <!-- Search box. -->
    <input type="text" id="search" placeholder="Search" />

    <!-- Suggestions will be displayed in below div. -->
    <div id="display"></div>

    <div>
        <p class="texto_pesquisa ml-4">Ativa a localização e desliza pelo mapa para descobrires os eventos que te rodeiam.</p>

    </div>


    <div class="ml-4">
        <?php
        include_once "mapacomeventos.php";
        ?>
    </div>


</main>


<?php
include_once "components/footer.php"; ?>

</body>
<script>
    //Getting value from "ajax.php".
    function fill(Value) {
        //Assigning value to "search" div in "search.php" file.
        $('#search').val(Value);
        //Hiding "display" div in "search.php" file.
        $('#display').hide();
    }
    $(document).ready(function() {
        //On pressing a key on "Search box" in "search.php" file. This function will be called.
        $("#search").keyup(function() {
            //Assigning search box value to javascript variable named as "name".
            var name = $('#search').val();
            //Validating, if "name" is empty.
            if (name == "") {
                //Assigning empty value to "display" div in "search.php" file.
                $("#display").html("");
            }
            //If name is not empty.
            else {
                //AJAX is called.
                 $.ajax({
                    //AJAX type is "Post".
                    type: "POST",
                    //Data will be sent to "ajax.php".
                    url: "outro.php",
                    //Data, that will be sent to "ajax.php".
                    data: {
                        //Assigning value of "name" into "search" variable.
                        search: name
                    },
                    //If result found, this funtion will be called.
                    success: function(html) {
                        //Assigning result to "display" div in "search.php" file.
                        $("#display").html(html).show();
                    }
                });
            }
        });
    });
</script>
</html>
