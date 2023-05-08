<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "conn" . DIRECTORY_SEPARATOR . "admin-conn.php";

    session_start();

    if ($_GET["animale"]) {
        $query = 'DELETE FROM animale WHERE nome = "' . $_GET["animale"] . '";';
        $queryResult = mysqli_query($mysqli, $query);

       //$url;

        if ($queryResult) {;
            //echo '<script type="text/javascript" src="' . ".." . DIRECTORY_SEPARATOR . "js" . DIRECTORY_SEPARATOR . "remove-animal.js" .'">','deleteFile('$url');','</script>';
            header("location:" . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "admin-page-animal-list.php" );
        }
    }
?>