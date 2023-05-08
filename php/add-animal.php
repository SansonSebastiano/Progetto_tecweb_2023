<?php
    include_once "conn/admin-conn.php";
    session_start();

    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $descrizione = $_POST['descrizione'];
    $data = $_POST['data_scoperta'];
    $path = $_POST['hidden'];

    $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path', '$nome')";

    $query = mysqli_query($mysqli, $sql);

    if($query){
        header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-animal.php ");
        exit();
    }
?>