<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_GET["animale"]) {
        $query = 'DELETE FROM animale WHERE nome = "' . $_GET["animale"] . '";';
        $queryResult = mysqli_query($mysqli, $query);

        $mysqli->close();

        if ($queryResult) {
            header("Location:" . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "admin-animal-list.php" );
            exit();
        }
    }
?>