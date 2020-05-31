<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="js/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Registo</title>
</head>
<body>

<header>
    <h3>
        <a href="inicio.php" style="text-decoration: none; color: #03bd03;">
            <i class="fas fa-chevron-left mr-2 ml-1"></i>
        </a>
        Registo
    </h3>

</header>
<main>

    <p class="mt-3 ml-4">Bem-vindo!</p>
    <p class="mt-0 ml-4">Começa por preencher os seguintes campos com as tuas informações.</p>

    <div class="row justify-content-around mr-0">


        <div class="col-10">

            <form action="scripts/user_register.php" method="post">

                <p class="mt-2 mb-0 text-left">Nome</p>
                <input class="pl-2 mt-1 w-100" type="text" name="nome" placeholder="ex: Tiago"
                       required="required">

                <p class="mt-1 mb-0 text-left">Apelido</p>
                <input class="pl-2 mt-1 w-100" type="text" name="nome" placeholder="ex: Santos"
                       required="required">

                <p class="mt-1 mb-0 text-left">Nome de Utilizador</p>
                <input class="pl-2 mt-1 w-100" type="text" name="nome" placeholder="@exemplo"
                       required="required">

                <p class="mt-2 mb-0 text-left">E-mail</p>
                <input class="pl-2 mt-1 w-100" type="email" name="mail" placeholder="exemplo@gmail.com"
                       required="required">

                <p class="mt-2 mb-0 text-left">Data de Nascimento</p>
                <input class="pl-2 mt-1 w-100" type="date" name="data_nasc" placeholder="dd/mm/yyyy"
                       required="required">

                <p class="mt-2 mb-0 text-left">Palavra-passe</p>
                <input class="pl-2 mt-1 w-100" type="password" name="pass" required="required" placeholder="Palavra-passe">

            </form>
        </div>
    </div>
    <div class="justify-content-center d-flex">
        <button type="submit" class="btn mt-3 botao_grande"> Confirmar </button>
    </div>
</main>
</body>
</html>