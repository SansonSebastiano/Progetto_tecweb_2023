<?php
    include_once "conn/admin-conn.php";
    session_start();
    $sql = "SELECT `nome` FROM `animale`";
    $query = mysqli_query($mysqli, $sql);
    $json_array = array();

    while($data = mysqli_fetch_assoc($query)){
        $json_array[]= $data;
    }
    echo json_encode($json_array);
?>