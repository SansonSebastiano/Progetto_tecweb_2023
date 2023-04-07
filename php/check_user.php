<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";
    const GUEST_ROLE = "guest";

    $log_in_out = " ";

    session_start();

    // check user privilege
    if (isset($_SESSION["ruolo"])) {
        if ($_SESSION["ruolo"] == ADMIN_ROLE) {
            $log_in_out = "<a href=\"./php/logout.php\">Esci</a>";
            require_once("." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "admin_conn.php");

        } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
            $log_in_out = "<a href=\"./php/logout.php\">Esci</a>";
            require_once("." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "writer_conn.php");

        } elseif ($_SESSION["ruolo"] == USER_ROLE) {
            $log_in_out = "<a href=\"./php/logout.php\">Esci</a>";
            require_once("." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "logged_conn.php");

        } else {
            $log_in_out = "<a href=\"./html/login_form.html\">Accedi</a>";
            $_SESSION["ruolo"] = GUEST_ROLE;
            require_once("." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "guest_conn.php");
        }
    } else {
        $log_in_out = "<a href=\"./html/login_form.html\">Accedi</a>";
        $_SESSION["ruolo"] = GUEST_ROLE;
        require_once("." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "guest_conn.php");
    }
?>