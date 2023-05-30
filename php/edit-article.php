<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["article"])) {
        $testo = clearInput(filter_input(INPUT_POST,"testo",FILTER_SANITIZE_SPECIAL_CHARS));

        $query = "UPDATE articolo SET contenuto = '$testo' WHERE id = '" . $_GET["article"] . "'";
        $queryResult = $queryResult = mysqli_query($mysqli, $query);

        if($queryResult) {
            header("Location: ./pages/article.php?article=" . $_GET["article"]);
        }
        else {
            echo "Errore nell'aggiornamento dell'articolo";
        }

        $queryResult->free();
        $mysqli->close();
    }
?>