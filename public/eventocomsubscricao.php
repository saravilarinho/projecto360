<?php

session_start();

if (isset($_SESSION['id_utilizador']) && isset($_GET['id'])){

    $id_utilizador = $_SESSION['id_utilizador'];
    $id_evento = $_GET['id'];

}
else{
    header("Location: login.php?message=2");

}

date_default_timezone_set('Europe/Lisbon');
$rn = date('h:i', time());




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
    mysqli_stmt_bind_result($stmt, $nome_evento,  $data_inicio, $hora_inicio, $data_fim, $hora_fim, $localizacao, $descricao, $categoria, $imagem, $lat, $lng, $favorito, $id_role);

    if (mysqli_stmt_fetch($stmt)) {

        ?>

        <!DOCTYPE html>
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

    <title><?=$nome_evento ?></title>

</head>
<body>
<main>

    <a href="eventos.php">
    <i class="fas fa-2x fa-chevron-circle-left voltar"></i></a>
   <?php
   if ($imagem != ''){
       ?>
       <img class="w-100" src="scripts/upload/<?=$imagem?>">
       <?php
   }
   else {
       ?>
       <img class="w-100" src="imagens/default-image.jpg">
       <?php
   }
   ?>


    <div class="pl-4 container superior_redondo">

        <div class="row">

            <p class="titulo_evento mb-3 mt-3 col-8">
                <?= $nome_evento ?></p>

            <span class="col-4 d-flex align-items-center justify-content-around">
            <a class="btn botao_favorito" href="scripts/favoritar_evento.php?id=<?=$id?>">
                    <?php
                    if ($favorito === 0) {
                        ?>
                        <i class="far fa-star" style="font-size: 15px;"></i>
                        <?php
                    } else {
                        if ($favorito === 1) {
                            ?><i class="fas fa-star" style="font-size: 15px;"></i>
                            <?php
                        }
                    }
                    ?>
            </a>
                    <?php
                    if ($id_role === 1) {
                        ?>
                        <a class="btn botao_favorito" href="editar_evento.php?id=<?= $id ?>">
                        <i class="far fa-edit" style="font-size: 15px;"></i>
                    </a>
                        <?php
                    }
                    ?>
            </span>
        </div>



        <ul class="nav nav-tabs justify-content-center">
            <li class="active mr-5"><a data-toggle="tab" href="#timeline" style="color: #3e3f80">Timeline</a></li>
            <li class="mr-5"><a data-toggle="tab" href="#mapa" style="color: #3e3f80">Mapa</a></li>
            <li><a data-toggle="tab" href="#atividade" style="color: #3e3f80;">Atividade</a></li>
        </ul>


        <div class="tab-content">
            <div id="timeline" class="tab-pane fade in active show">
                        <div class="order-timeline">

                            <?php
                            $agora_dia = date("Y-m-d");
                            $agora_hora = date("H:i");

                            if ($agora_dia > $data_inicio ){

                                //ja começou o evento || check dia

                                $hora_inicio_dir = date('H:i', strtotime('+0 hour', strtotime($hora_inicio)));
                                $hora_fim_dir = date('H:i', strtotime('+0 hour', strtotime($hora_fim)));
                                $start = date('H:i', strtotime('+0 hour', strtotime($hora_inicio)));


                                if ($agora_hora >= $hora_inicio_dir){
                                    $tempo = 0;

                                    $iniciodoeventomesmo = date('Y-m-d H:i:s', strtotime('+0 hour', strtotime($data_inicio . $hora_inicio)));
                                    $fimdoeventomesmo = date('Y-m-d H:i:s', strtotime('+0 hour', strtotime($data_fim . $hora_fim)));


                                    while($iniciodoeventomesmo <= $fimdoeventomesmo){
                                        $start=date('H:i', strtotime('+'.$tempo.' hour', strtotime($hora_inicio)));
                                        ?>



                                        <div class="timeline-object complete">
                                            <div class="timeline-status"></div>
                                            <div class="timeline-p">
                                                <div class="hora"><?=$start?></div>
                                                <a href="grelhasemphp.php?id=<?=$id_evento?>&hora=<?=$start?>">
                                                <div class="fotografias">
                                                    <?php
                                                    require_once "../admin/connections/connection2db.php";

                                                    $link = new_db_connection();
                                                    $stmt = mysqli_stmt_init($link);

                                                    $query = "SELECT publicacoes.conteudo_publicacao, publicacoes.data_publicacao, eventos.data_inicio_evento, eventos.hora_inicio 
                                                              FROM publicacoes 
                                                              INNER JOIN eventos
                                                              ON publicacoes.eventos_id_evento = eventos.id_evento
                                                              WHERE publicacoes.data_publicacao BETWEEN ? AND ? AND publicacoes.eventos_id_evento = ?
                                                              ORDER BY publicacoes.id_publicacao DESC
                                                              LIMIT 6";


                                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                                        mysqli_stmt_bind_param($stmt, 'ssi', $inicio, $fim, $id);

                                                        $inicio = date('Y-m-d H:i:s', strtotime('+0 hour', strtotime($data_inicio . $start)));
                                                        $fim = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($data_inicio . $start)));
                                                        $id = $_GET["id"];

                                                        mysqli_stmt_execute($stmt);

                                                        mysqli_stmt_bind_result($stmt, $conteudo, $data_pub, $data_inicio_evento, $hora_inicio_evento);


                                                        while (mysqli_stmt_fetch($stmt)) {

                                                            ?>
                                                            <img class="img_timeline" src="scripts/upload/<?=$conteudo?>">
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                </a>
                                            </div>
                                        </div>

                                        <?php




                                        $iniciodoeventomesmo = date('Y-m-d H:i:s', strtotime('+'.$tempo.' hour', strtotime($data_inicio . $hora_inicio)));
                                        $tempo++;





                                    }
                                }
                                else{
                                    ?>
                                    <div class="timeline-object complete">
                                        <div class="timeline-status"></div>
                                        <div class="timeline-p">
                                            <div class="inicio_evento ">O evento irá iniciar dentro de umas horas!</div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>


                                <div class="timeline-object complete">
                                    <div class="timeline-status"></div>
                                    <div class="timeline-p">
                                        <div class="inicio_evento fonte_menu" >Inicio do evento!</div>

                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                //ainda nao comecou || dia check

                                ?>
                                <p class="col-10 align-self-center">O evento ainda não tem conteúdos associados durante o seu período de duração.</p>
                                <?php

                            }
                            ?>




                            <div class="timeline-object complete">
                                <div class="timeline-status"></div>
                                <div class="timeline-p">
                                    <div class="inicio_evento fonte_menu"><b>Pré-Evento</b></div>
                                    <p class="align-self-center">Conteúdos adicionados pela organização.</p>

                                </div>
                            </div>

                        </div>



            </div>


            <div id="mapa" class="tab-pane fade in">
                <?php
                include_once "mapacomeventos.php";
                ?>






            </div>


            <div id="atividade" class="tab-pane fade in">


                <?php
                require_once "../admin/connections/connection2db.php";

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "CALL atividade_cont($id_evento)";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $nome, $id_p, $data);
?>
                <div class="container mt-4">

                <?php

                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                        <div class="row align-items-center">
                            <img class="col-2 align-self-center pb-2" src="imagens/icones/icone_mais.png">
                            <p class="col-10 align-self-center">
                                <small><?=$nome?> adicionou <a class="link_conteudos" href="publicacao.php?idp=<?=$id_p?>">conteúdos</a> ao evento.</small>
                                <small class="tempo_atras"><?php echo time_elapsed_string($data);?></small>
                            </p>
                        </div>

                        <?php
                    }
                }
?>
                </div>
<?php

            require_once "../admin/connections/connection2db.php";

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "CALL atividade_sub($id_evento)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt,  $id, $evento, $nome, $dataa);
                    ?>

                <div class="container mt-2">
                    <?php
                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                        <div class="row align-items-center">
                            <img class="col-2 align-self-center" src="imagens/icones/icone_festa.png">
                            <p class="col-10 align-self-center">
                                <small><?=$nome?> subscreveu o evento.</small>
                                <small class="tempo_atras"><?php echo time_elapsed_string($dataa);?></small>

                            </p>
                        </div>

                        <?php
                    }
            }
                    ?>



                </div>
            </div>
        </div>
    </div>
</main>


</body>
</html>


        <?php
    }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ano',
        'm' => 'mês',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atrás' : 'agora';
}

?>



