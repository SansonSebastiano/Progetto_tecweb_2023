<?php
    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";
    const GUEST_ROLE = "guest";
    const NO_ROLE = "no_role";

    $log_in_out = " ";
    $user = " ";

    $logoutPath = DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "logout.php";
    $loginPath = DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "login.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $role = $_SESSION["ruolo"] ?? NO_ROLE;
    // check user privilege
    switch ($role) {
        case ADMIN_ROLE:
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
            require($conn_path . "admin-conn.php");
            break;
        case WRITER_ROLE:
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
            require($conn_path . "writer-conn.php");
            break;
        case USER_ROLE:
            $log_in_out = "<a href=" . $logoutPath . " tabindex='1'>Esci</a>";
            require($conn_path . "user-conn.php");
            break;
        case GUEST_ROLE:
            $log_in_out = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";
            require($conn_path . "guest-conn.php");
            break;
        default:
            $log_in_out = "<a href=" . $loginPath . " tabindex='1'>Accedi</a>";
            $_SESSION["ruolo"] = GUEST_ROLE;
            require($conn_path . "guest-conn.php");
            break;
    }

?>