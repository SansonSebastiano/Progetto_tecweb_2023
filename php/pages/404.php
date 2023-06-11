<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    

    $page = file_get_contents($html_path . "404.html");
    $goUpPath = "../../";
    include $php_path . "template-loader.php";

    echo $page;
?>