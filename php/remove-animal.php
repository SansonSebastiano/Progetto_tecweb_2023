<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_GET["animale"]) {
        $query = 'DELETE FROM animale WHERE nome = "' . $_GET["animale"] . '";';
        $queryResult = mysqli_query($mysqli, $query);

        if ($queryResult) {
            $mysqli->close();
            header("Location: " . $admin_page_animal_list_ref);
            exit();
        }
    }
?>