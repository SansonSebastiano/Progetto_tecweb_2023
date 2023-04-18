<?php
    session_start();
    session_destroy();
    
    //echo "<script>console.log('SESSION DESTROYED');</script>";

    header("Location: " . ".." . DIRECTORY_SEPARATOR . "index.php");
?>