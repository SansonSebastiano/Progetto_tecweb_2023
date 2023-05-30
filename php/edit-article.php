<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["article"])) {

        $testo = clearInput($_POST['testo']);
        $ok = true;

        if(strlen($testo) < 20 ){
            $errorStrings["testo"] = "Il testo dell'articolo deve essere lungo almeno 20 caratteri";
            $ok = false;
        }else{
            $errorStrings["testo"] = "";
        }

        $testo = filter_var($testo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($ok){
            $query = "UPDATE articolo SET contenuto = '$testo' WHERE id = '" . $_GET["article"] . "'";
            $queryResult = mysqli_query($mysqli, $query);
        }

        if($ok && $queryResult) {
            header("Location: ./pages/article.php?article=" . $_GET["article"]);
        }
        else {
            $_SESSION["error-result"] = "<p class='error'>Errore nell'aggiornamento dell'articolo</p>";
            $_SESSION["error-strings"] = $errorStrings;
            header("Location: ./pages/form-edit-article.php?article=" . $_GET["article"]);
        }

        $queryResult->free();
        $mysqli->close();
    }
?>