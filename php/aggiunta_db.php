<?php
    include_once '../php/connection_database.php';
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $descrizione = $_POST['descrizione'];
    $data = $_POST['data_scoperta'];
    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`,`image_path`) VALUES ('$nome', '$descrizione', '$status', '$data', 'aasasassasa')";
    $query = mysqli_query($connessione, $sql);
    if($query)
    {
        header("location: ../html/aggiunta_animale.html");
        exit();}
    else{
        echo '<p>Wrong stuff</p>';
    }
?>