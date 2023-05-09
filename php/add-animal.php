<?php
     include "conn" . DIRECTORY_SEPARATOR . "admin-conn.php";
     include "input-cleaner.php";

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $nome = clearInput($_POST['name']);
    $status = clearInput($_POST['status']);
    $descrizione = clearInput($_POST['description']);
    $data = clearInput($_POST['data_scoperta']);
    $path = clearInput($_POST['hidden']);

    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path', '$nome')";

    $query = mysqli_query($mysqli, $sql);

    if ($query) {
        // free the result set
        //$query->free();
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-animal.php ");
        exit();
    }
?>