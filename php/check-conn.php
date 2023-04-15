<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";
    const GUEST_ROLE = "guest";

    $log_in_out = " ";
    $logoutPath = $_SESSION["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $loginPath = $_SESSION["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "login-form.html";

    session_start();

    // check user privilege
    if (isset($_SESSION["ruolo"])) {
        if ($_SESSION["ruolo"] == ADMIN_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . ">Esci</a>";
            //$log_in_out = "<a href=\"./php/logout.php\">Esci</a>";
            require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "conn" . DIRECTORY_SEPARATOR . "admin-conn.php");

        } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . ">Esci</a>";
            require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "conn" . DIRECTORY_SEPARATOR . "writer-conn.php");

        } elseif ($_SESSION["ruolo"] == USER_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . ">Esci</a>";
            require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "conn" . DIRECTORY_SEPARATOR . "logged-conn.php");

        } else {
            $log_in_out = "<a href=" . $loginPath . ">Accedi</a>";
            //$log_in_out = "<a href=\"./html/login-form.html\">Accedi</a>";
            $_SESSION["ruolo"] = GUEST_ROLE;
            require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "conn" . DIRECTORY_SEPARATOR . "guest-conn.php");
        }
    } else {
        $log_in_out = "<a href=" . $loginPath . ">Accedi</a>";
        $_SESSION["ruolo"] = GUEST_ROLE;
        require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "conn" . DIRECTORY_SEPARATOR . "guest-conn.php");
    }
?>