<?php
    $db_host = 'localhost';
    $db_user = 'fceccato';
    $db_db = 'fceccato';

    $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
        
    if ($mysqli->connect_error) {
        exit();
    }

?>