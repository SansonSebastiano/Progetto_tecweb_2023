<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin') {
        $mysqli->close();
        header("Location: " . $index_ref);
        exit();
    }

    $_SESSION["prev_page"] =  $admin_page_ref;

    $page = file_get_contents($html_path . "admin-home.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    echo $page;
?>