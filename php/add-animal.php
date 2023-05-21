<?php
     include "db-conn.php";
     include "input-cleaner.php";

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $nome = clearInput($_POST['name']);
    $status = clearInput($_POST['status']);
    $descrizione = clearInput($_POST['description']);
    $data = clearInput($_POST['data_scoperta']);
    $path = clearInput($_POST['hidden']);

    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path')";

    $query = mysqli_query($mysqli, $sql);

    $mysqli->close();

    if ($query) {
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-animal.php ");
        exit();
    }
    
?>