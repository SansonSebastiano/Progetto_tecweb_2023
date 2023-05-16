<?php
     include "conn" . DIRECTORY_SEPARATOR . "admin-conn.php";
     include "input-cleaner.php";

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $text = clearInput($_POST['text']);
    $autore = $_SESSION['id'];
    $article = $_POST["hidden"];
    $date_time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO `commento` (`articolo`, `utente`, `contenuto`, `data`) VALUES ('$article', '$autore', '$text', '$date_time')";
    $queryResult = mysqli_query($mysqli, $sql);
    if ($queryResult) {
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "article.php?article=$article");
        exit();
    }
    
?>