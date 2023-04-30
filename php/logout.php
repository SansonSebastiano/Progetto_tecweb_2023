<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    
    //echo "<script>console.log('SESSION DESTROYED');</script>";

    header("Location: " . DIRECTORY_SEPARATOR . "index.php")
?>