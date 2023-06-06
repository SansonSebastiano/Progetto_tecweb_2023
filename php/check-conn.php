<?php
    const GUEST_ROLE = "guest";

    $log_in_out = " ";

    // logout
    $logoutPath = $root_client_side . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $logout_ref = "<a href=\"" . $logoutPath . "\" tabindex='1'>" . $icon_logout_ref . "</a>";
    // login
    $loginPath = $root_client_side . "html" . DIRECTORY_SEPARATOR . "form-login.html";
    $login_ref = "<a href=\"" . $loginPath . "\" tabindex='1'>Accedi</a>";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // check user privileges
    if (isset($_SESSION["ruolo"])) {
        $log_in_out = $_SESSION["ruolo"] == GUEST_ROLE ? $login_ref : $logout_ref;
    } else {
        $_SESSION["ruolo"] = GUEST_ROLE;
        $log_in_out = $login_ref;
    }

?>