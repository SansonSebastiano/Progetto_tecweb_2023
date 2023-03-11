<?php
    include_once '../php/connection_database.php';
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $descrizione = $_POST['descrizione'];
    $data = $_POST['data_scoperta'];

    $query = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`) VALUES ('$nome', '$descrizione', '$status', '$data')";

    if ($result = $mysqli -> query($query)) {
        echo "Returned rows are: " . $result -> num_rows;
        // Free result set
        $result -> free_result();
    }
    
    $mysqli->close();
?>