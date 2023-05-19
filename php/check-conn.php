<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";
    const GUEST_ROLE = "guest";

    $log_in_out = " ";
    $user = " ";

    $logoutPath = $root_client_side . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $loginPath = $root_client_side . "html" . DIRECTORY_SEPARATOR . "form-login.html";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // check user privilege
    if (isset($_SESSION["ruolo"])) {
        if ($_SESSION["ruolo"] == ADMIN_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";

        } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";

        } elseif ($_SESSION["ruolo"] == USER_ROLE) {
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
        } 
        else {
            $log_in_out = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";
            $_SESSION["ruolo"] = GUEST_ROLE;
            $_SESSION["username"] = "";
        }
    } else {
        $log_in_out = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";
        $_SESSION["ruolo"] = GUEST_ROLE;
        $_SESSION["username"] = "";
    }

?>