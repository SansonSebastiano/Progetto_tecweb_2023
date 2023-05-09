<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";

    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";
    const GUEST_ROLE = "guest";

    $log_in_out = " ";

    $logoutPath = DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $loginPath = DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "form-login.html";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // check user privilege
    if (isset($_SESSION["ruolo"])) {
        if ($_SESSION["ruolo"] == ADMIN_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
            require($conn_path . "admin-conn.php");

        } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
            require($conn_path . "writer-conn.php");

        } elseif ($_SESSION["ruolo"] == USER_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
            require($conn_path . "user-conn.php");

        } else {
            $log_in_out = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";
            require($conn_path . "guest-conn.php");
        }
    } else {
        $log_in_out = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";
        $_SESSION["ruolo"] = GUEST_ROLE;
        require($conn_path . "guest-conn.php");
    }
?>