<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500&display=swap" rel="stylesheet">

    <!-- Ligacoes -->
    <script src="interacoes.js" ></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>


    <script>
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId());
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail());

            var id_token = googleUser.getAuthResponse().id_token;

            console.log(id_token)
        }
    </script>

    <title>Registo</title>
</head>
<body>

<header>
    <h3>
        <a href="../index.php" style="text-decoration: none; color: #03bd03;">
            <i class="fas fa-chevron-left mr-2 ml-1"></i>
        </a>
        Registo
    </h3>

</header>
<main>

    <p class="mt-3 ml-4 texto_pesquisa">Bem-vindo!</p>
    <p class="mt-0 ml-4 mr-3 texto_pesquisa">Começa por preencher os seguintes campos com as tuas informações.</p>

    <div class="row justify-content-around mr-0">


        <div class="col-10">

            <div class="g-signin2" data-onsuccess="onSignIn" >
            </div>

            <form action="scripts/registo_utilizadores.php" role="form" method="post">

                <p class="mt-2 mb-0 label">Nome</p>
                <input class="pl-2 mt-1 w-100 form-control campo_form" type="text" name="name" placeholder="ex: Tiago"
                       required="required">

                <p class="mt-2 mb-0 label ">E-mail</p>
                <input class="pl-2 mt-1 w-100 form-control campo_form" type="email" name="email" placeholder="exemplo@gmail.com"
                       required="required">

                <p class="mt-2 mb-0 label">Palavra-passe</p>
                <input class="pl-2 mt-1 w-100 form-control campo_form" type="password" name="password_hash" required="required" placeholder="Palavra-passe">

                <p class="mt-2 mb-0 label">Confirmação da Palavra-passe</p>
                <input class="pl-2 mt-1 w-100 form-control campo_form" type="password" name="password_hash1" required="required" placeholder="Confirmação da Palavra-passe">

                <div class="justify-content-center d-flex fixed-bottom position-fixed mb-3">
                    <button type="submit" class="btn botao_grande"> Confirmar </button>
                </div>
            </form>

        </div>
    </div>

</main>
</body>


</html>