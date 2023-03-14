<?php
    include_once '../php/connection_database.php';

    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $descrizione = $_POST['descrizione'];
    $data = $_POST['data_scoperta'];

    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`) VALUES ('$nome', '$descrizione', '$status', '$data')";

    $query = mysqli_query($mysqli, $sql);

    if($query) {
        echo '<br>';
	    echo "Successo";
    } else {
        echo '<br>';
        echo "Errore";
    }
?>