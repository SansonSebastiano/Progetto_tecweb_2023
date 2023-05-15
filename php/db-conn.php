<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'my_elusive';

    $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);

    $logConn;
        
    if ($mysqli->connect_error) {
        $logConn = " connection failed.";
        //$isConn = "<script>console.log('Connection failed.');</script>";
        exit();
    }
    $logConn = " connection estabilished.";
    //$isConn = "<script>console.log('Connection estabilished.');</script>";
    ?>