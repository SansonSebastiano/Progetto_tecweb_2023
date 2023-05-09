<?php
     include "conn" . DIRECTORY_SEPARATOR . "admin-conn.php";

    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $nome = $_POST['name'];
    $status = $_POST['status'];
    $descrizione = $_POST['description'];
    $data = $_POST['data_scoperta'];
    $path = $_POST['hidden'];

    // TODO: clear input

    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path', '$nome')";

    $query = mysqli_query($mysqli, $sql);

    if ($query) {
        // free the result set
        //$query->free();
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-animal.php ");
        exit();
    }
?>