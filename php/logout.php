<?php
    session_start();
    session_destroy();
    
    echo "<script>console.log('SESSION DESTROYED');</script>";

    // da chiudere anche la connessione al db? è dunque necessario customizzare il metodo di chiusura della connessione?

    header("Location: " . $_SESSION['DOCUMENT_ROOT'] . "/index.php");
?>