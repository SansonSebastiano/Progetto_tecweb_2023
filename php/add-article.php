<?php
    include_once "conn/admin-conn.php";
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $titolo = $_POST['titolo'];
    $sottotitolo = $_POST['Sottotitolo'];
    $tag = $_POST['tag'];
    $luogo = $_POST['luogo'];
    $data = $_POST['data_scrittura'];
    $testo = $_POST['testo'];
    $autore = $_SESSION['id'];
    $path = $_POST['hidden'];
    $creatura = $_POST['creatura'];

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