<?php

//Including Database configuration file.
require_once "../admin/connections/connection2db.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {
    //Search box value assigning to $Name variable.
    $Name = $_POST['search'];
    //Search query.
    $Query = "SELECT nome_evento FROM eventos WHERE nome_evento LIKE '%$Name%' LIMIT 5";
    //Query execution
    $ExecQuery = MySQLi_query($link, $Query);
    //Creating unordered list to display result.
    echo '<ul>';

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {
        ?>

        <!-- Creating unordered list itemsCalling javascript function named as "fill" found in "script.js" file.
    By passing fetched result as parameter. -->

        <li onclick='fill("<?php echo $Result['nome_evento']; ?>")'>

            <a>

                <!-- Assigning searched result in "Search box" in "search.php" file. -->
                <?php echo $Result['nome_evento']; ?>

        </li></a>
        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

        <?php

    }
}

?>
</ul>


