<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";
    const GUEST_ROLE = "guest";
    const NO_ROLE = "no_role";

    $log_in_out = " ";
    $user = " ";

    // logout
    $logoutPath = DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $logout_ref = "<a href=" . $logoutPath . " tabindex='1'>" . $icon_logout_ref . "</a>";
    // login
    $loginPath = DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "form-login.html";
    $login_ref = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // check user privileges
    if (isset($_SESSION["ruolo"])) {
        if ($_SESSION["ruolo"] == ADMIN_ROLE) {
            $log_in_out = $logout_ref;
            $user = $_SESSION["ruolo"] . $logConn;
        } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
            $log_in_out = $logout_ref;
            $user = $_SESSION["ruolo"] . $logConn;
        } elseif ($_SESSION["ruolo"] == USER_ROLE) {
            $log_in_out = $logout_ref;
            $user = $_SESSION["ruolo"] . $logConn;
        } else {    // GUEST_ROLE
            $log_in_out = $login_ref;
            $user = $_SESSION["ruolo"] . $logConn;
        }
    } else {
        $log_in_out = $login_ref;
        $_SESSION["ruolo"] = GUEST_ROLE;
        $user = $_SESSION["ruolo"] . $logConn;
    }

?>