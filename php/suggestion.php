<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin' && $_SESSION['ruolo'] != 'writer') {
        //echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
    }

    $sql = "SELECT `nome` FROM `animale`";
    $query = mysqli_query($mysqli, $sql);
    $json_array = array();

    while($data = mysqli_fetch_assoc($query)){
        $json_array[]= $data;
    }
    echo json_encode($json_array);
?>