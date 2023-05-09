<?php
     include "conn" . DIRECTORY_SEPARATOR . "writer-conn.php";
     include "input-cleaner.php";
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $titolo = clearInput($_POST['titolo']);
    $sottotitolo = clearInput($_POST['Sottotitolo']);
    $tag = clearInput($_POST['tag']);
    $luogo = clearInput($_POST['luogo']);
    $data = clearInput($_POST['data_scrittura']);
    $testo = clearInput($_POST['testo']);
    $autore = clearInput($_SESSION['id']);
    $path = clearInput($_POST['hidden']);
    $creatura = clearInput($_POST['creatura']);

    $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`alt`) VALUES ('$autore', '$titolo', '$data', '$luogo', '$sottotitolo', '$testo', '$path', '$tag', 0, '$testo')";
    $queryResult = mysqli_query($mysqli, $sql);
    $id_query = "SELECT MAX(`id`) FROM `articolo`";
    $queryResult = mysqli_query($mysqli,$id_query);
    $data = mysqli_fetch_array($queryResult);
    $id = $data[0];
    if ($queryResult) {
        // free the result set
        $queryResult->free();
    }
    //TODO: inserire articolo_animale
    
    $sql = "INSERT INTO `articolo_animale` (`articolo`,`animale`) VALUES ('$id', '$creatura')";
    $queryResult = mysqli_query($mysqli,$sql);

    if ($queryResult) {
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-article.php ");
        exit();
    }
?>