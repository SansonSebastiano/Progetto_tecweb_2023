<?php
    const GUEST_ROLE = "guest";

    $log_in_out = " ";

    
    $logoutPath = $root_client_side . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $logout_ref = "<a href=\"" . $logoutPath . "\" tabindex='0'>" . $icon_logout_ref . "</a>";
    
    $loginPath = $root_client_side . "php" . DIRECTORY_SEPARATOR . "login.php";
    $login_ref = "<a href=\"" . $loginPath . "\" tabindex='0'>Accedi</a>";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    
    if (isset($_SESSION["ruolo"])) {
        $log_in_out = $_SESSION["ruolo"] == GUEST_ROLE ? $login_ref : $logout_ref;
    } else {
        $_SESSION["ruolo"] = GUEST_ROLE;
        $log_in_out = $login_ref;
    }

?>