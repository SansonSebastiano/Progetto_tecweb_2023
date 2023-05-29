<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "check-conn.php";
    include "db-conn.php";
    include "input-cleaner.php";

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $text = clearInput(filter_input(INPUT_POST,"text",FILTER_SANITIZE_SPECIAL_CHARS));
    $autore = $_SESSION['id'];
    $article = $_POST["hidden-article"];
    $date_time = date("Y-m-d H:i:s");
    $reply = $_POST["hidden-bool"];
    $sql = "INSERT INTO `commento` (`articolo`, `utente`, `contenuto`, `data`) VALUES ('$article', '$autore', '$text', '$date_time')";
    $queryResult = mysqli_query($mysqli, $sql);
    if($reply == "true"){
        $commentoPadre = $_POST["hidden-comment"];
        $id_query = "SELECT MAX(`id`) FROM `commento`";
        $idResult = mysqli_query($mysqli,$id_query);
        $data = mysqli_fetch_array($idResult);
        $id = $data[0];
        
        if ($idResult) {
            // free the result set
            $idResult->free();
        }
        $sql = "INSERT INTO `risposta` (`figlio`, `padre`) VALUES ('$id', '$commentoPadre')";
        $queryResult = mysqli_query($mysqli, $sql);
    }
    
    
    if ($queryResult) {
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "article.php?article=$article");
        exit();
    }
    
?>