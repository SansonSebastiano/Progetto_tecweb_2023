<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_db = 'my_elusive';

    $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
        
    if ($mysqli->connect_error) {
        exit();
    }

?>