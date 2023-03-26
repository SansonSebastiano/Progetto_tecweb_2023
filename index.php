<?php
    require("." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "guest_conn.php");

    $page = file_get_contents("." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "index.html");
    
    echo $page;
?>