<?php
    include_once "conn/writer-conn.php";
    
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

    $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`alt`) VALUES ('$autore', '$titolo', '$data', '$luogo', '$sottotitolo', '$testo', '$path', '$tag', 0, 'testo')";

    $query = mysqli_query($mysqli, $sql);

    if($query){
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-article.php ");
        exit();
    }
?>