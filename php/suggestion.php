<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin' && $_SESSION['ruolo'] != 'writer') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }

    $sql = "SELECT `nome` FROM `animale`";
    $query = mysqli_query($mysqli, $sql);
    $json_array = array();

    while($data = mysqli_fetch_assoc($query)){
        $json_array[]= $data;
    }
    echo json_encode($json_array);

    $mysqli->close();
?>