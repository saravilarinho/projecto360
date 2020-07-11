<?php
session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id']) && isset($_GET['hora'])) {

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_evento = $_GET['id'];
    $hora = $_GET['hora'];

} else {
    header("Location: login.php?message=2");

}


?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500&display=swap" rel="stylesheet">

    <!-- Ligacoes -->
    <script src="interacoes.js"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://kit.fontawesome.com/2a97b08cd6.js" crossorigin="anonymous"></script>
    <title>Cluster</title>

</head>

<style>

    .imagem_grelha {
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

</style>

<body>

<?php
require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT nome_evento, data_inicio_evento, hora_inicio,  data_fim_evento, hora_fim, localizacao_evento, descricao_evento, 
categorias_id_categoria, imagem_evento, coor_lat, coor_long, utilizadores_has_eventos.favorito, utilizadores_has_eventos.roles_id_role
          FROM eventos
          INNER JOIN utilizadores_has_eventos
          ON eventos.id_evento = utilizadores_has_eventos.eventos_id_evento 
          WHERE eventos.id_evento = ? AND utilizadores_has_eventos.utilizadores_id_utilizador = ?";


if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'ii', $id, $id_user);

    $id = $id_evento;
    $id_user = $id_utilizador;

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome_evento, $data_inicio, $hora_inicio, $data_fim, $hora_fim, $localizacao, $descricao, $categoria, $imagem, $lat, $lng, $favorito, $id_role);

    if (mysqli_stmt_fetch($stmt)) {

        ?>
        <main>

            <a href="eventos.php">
                <i class="fas fa-2x fa-chevron-circle-left voltar"></i></a>
            <?php
            if (isset($imagem)) {
                ?>
                <img class="w-100" src="scripts/upload/<?= $imagem ?>">
                <?php
            } else {
                ?>
                <img class="w-100" src="imagens/evento1.jpeg?>">
                <?php
            }
            ?>


            <div class="pl-4 container superior_redondo">

                <div class="row">

                    <p class="titulo_evento mb-3 mt-3 col-8">
                        <?= $nome_evento ?></p>

                    <span class="col-4 d-flex align-items-center justify-content-around">
                <a class="btn botao_favorito" href="scripts/favoritar_evento.php?id=<?= $id_evento ?>">
                  <?php
                  if ($favorito === 0) { ?>
                      <i class="far fa-star" style="font-size: 15px;"></i>
                      <?php
                  } else {
                      if ($favorito === 1) { ?>
                          <i class="fas fa-star" style="font-size: 15px;"></i>
                          <?php
                      }
                  }
                  ?>
                </a>

                <?php
                if ($id_role === 1) { ?>
                    <a class="btn botao_favorito" href="editar_evento.php?id=<?= $id ?>">
                        <i class="far fa-edit" style="font-size: 15px;"></i>
                        </a>

                    <?php
                }
                ?>

                </span>
                </div>


                <ul class="nav nav-tabs justify-content-center">
                    <li class="active mr-5"><a data-toggle="tab" href="#timeline" style="color: #3e3f80">Timeline</a>
                    </li>
                    <li class="mr-5"><a data-toggle="tab" href="#mapa" style="color: #3e3f80">Mapa</a></li>
                    <li><a data-toggle="tab" href="#atividade" style="color: #3e3f80;">Atividade</a></li>
                </ul>


                <div class="tab-content">
                    <div id="timeline" class="tab-pane fade in active show">


                        <a href="eventos.php">
                            <div class="row">
                                <i class="fas fa-2x fa-chevron-circle-left voltar" style="color: #1ec5bc"></i>
                                <p style="color: #0a2b1d"><?= $hora ?></p>
                            </div>
                        </a>


                        <div class="container">
                            <div class="row">

                                <?php
                                require_once "../admin/connections/connection2db.php";

                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);

                                $query = "SELECT publicacoes.id_publicacao, publicacoes.conteudo_publicacao, publicacoes.data_publicacao, eventos.data_inicio_evento, eventos.hora_inicio 
                                  FROM publicacoes 
                                  INNER JOIN eventos
                                  ON publicacoes.eventos_id_evento = eventos.id_evento
                                  WHERE publicacoes.data_publicacao BETWEEN ? AND ? AND publicacoes.eventos_id_evento = ?
                                  ORDER BY publicacoes.id_publicacao DESC";


                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_bind_param($stmt, 'ssi', $inicio, $fim, $id);

                                    $inicio = date('Y-m-d H:i:s', strtotime('+0 hour', strtotime($data_inicio . $hora)));
                                    $fim = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($data_inicio . $hora)));
                                    $id = $id_evento;

                                    mysqli_stmt_execute($stmt);

                                    mysqli_stmt_bind_result($stmt, $id_p, $conteudo, $data_pub, $data_inicio_evento, $hora_inicio_evento);


                                    while (mysqli_stmt_fetch($stmt)) {

                                        ?>

                                        <a href="publicacao.php?idp=<?= $id_p ?>">
                                            <div class="col-3 m-2 imagem_grelha" onclick="publicacao()" id="pub"
                                                 style="height: 90px; background-image: url('scripts/upload/<?= $conteudo ?>'">

                                            </div>
                                        </a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>


                    </div>

                </div>

            </div>

        </main>
        <?php
    }
}
?>
</body>

</html>
