<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $sql = "SELECT `nome` FROM `animale`";
    $query = mysqli_query($mysqli, $sql);
    $json_array = array();

    while($data = mysqli_fetch_assoc($query)){
        $json_array[]= $data;
    }
    $mysqli->close();
?>