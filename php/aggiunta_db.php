<?php
    include_once '../php/connection_database.php';
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $descrizione = $_POST['descrizione'];
    $data = $_POST['data_scoperta'];
    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`) VALUES ('$nome', '$descrizione', '$status', '$data')";
    $query = mysqli_query($connessione, $sql);
    if($query)
    {
        header("location: ../html/aggiunta_animale.html");
        exit();
    }
?>