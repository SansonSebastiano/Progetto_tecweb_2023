<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";

    session_start();

    // check user privilege
    if (isset($_SESSION["ruolo"])) {
        if ($_SESSION["ruolo"] == ADMIN_ROLE) {
            header("Location: admin.php");
        } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
            header("Location: writer.php");
        } else {
            header("Location: index.php");
        }
    }
?>
