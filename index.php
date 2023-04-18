<?php
    require "config.php";
    require $php_path . "check-conn.php";
    
    session_start();
    $_SESSION["prev_page"] = ".." . DIRECTORY_SEPARATOR . "index.php";;

    $page = file_get_contents($html_path . "index.html");

    $page = str_replace("<user />", "Ciao, " . $_SESSION["username"], $page);
    $icon_user = "<img src=\"images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "icon-user.png\" class = \"profile-pic\" alt = \"utente\"/>";
    $page = str_replace("<user-img />", $icon_user, $page);
    $page = str_replace("<log-in-out />", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    echo $page;
?>