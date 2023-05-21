<?php
    $db_host = 'localhost';
    $db_user = 'fceccato';
    $db_password = 'iiP5aiboo3mootho';
    $db_db = 'fceccato';

    $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
        
    if ($mysqli->connect_error) {
        exit();
    }

?>