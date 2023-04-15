<?php
    include_once "";

    $titolo = $_POST['titolo'];
    $sottotitolo = $_POST['sottotitolo'];
    $tag = $_POST['tag'];
    $luogo = $_POST['luogo'];
    $data = $_POST['data_scrittura'];
    $testo = $_POST['testo'];
    $autore = $_POST[''];
    $path = $_POST['hidden'];

    //$sql = "INSERT INTO `article` (`titolo`, `descrizione`, `status`, `data_scoperta`, `image_path`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path')";

    $query = mysqli_query($connessione, $sql);

    if($query){
        header("location: ../html/form-add-article.html");
        exit();
    }
?>