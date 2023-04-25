<?php
    require "config.php";
    require $php_path . "check-conn.php";
    
    session_start();
    $_SESSION["prev_page"] = $index_ref;

    $page = file_get_contents($html_path . "index.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    $admin_section = "<button class=\"btn btn-primary\" onclick=\"location.href='" . $admin_page . "'\">Sezione Admin</button>";

    if ($_SESSION["ruolo"] == "admin") {
        $page = str_replace("<admin-section/>", $admin_section, $page);
    } else {
        $page = str_replace("<admin-section/>", "", $page);
    }

    echo $page;
?>
