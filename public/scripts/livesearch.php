<?php

//Including Database configuration file.
require_once "../../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

//Getting value of "search" variable from "livesearch-ajax.js".

if (isset($_POST['search'])) {
    //Search box value assigning to $Name variable.
    $Name = $_POST['search'];
    //Search query.
    $Query = "SELECT id_evento, nome_evento FROM eventos WHERE nome_evento LIKE '%$Name%' LIMIT 5";
    //Query execution
    $ExecQuery = MySQLi_query($link, $Query);
    //Creating unordered list to display result.
    echo '<ul>';

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {
        ?>

        <!-- Creating unordered list itemsCalling javascript function named as "fill" found in "livesearch-ajax.js" file.
    By passing fetched result as parameter. -->

        <ul onclick='fill("<?php echo $Result['nome_evento']; ?>")' class="pesquisa_resultado">

            <a style="font-size: 0.8rem; text-decoration: none;color: #1ec5bc;" href="scripts/verifica_evento.php?id=<?=$Result['id_evento']?>">

                <!-- Assigning searched result in "Search box" in "search.php" file. -->
                <?php echo $Result['nome_evento']; ?>

        </ul>
        </a>
        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

        <?php

    }
}

?>
</ul>


