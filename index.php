<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "check_conn.php");

    session_start();
    $_SESSION["prev_page"] = "../index.php";

    $page = file_get_contents("." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "index.html");

    $page = str_replace("<user />", "Ciao, " . $_SESSION["username"], $page);
    $page = str_replace("<userImg />", "<img src=\"images/icons/icon-user.png\" class = \"profile-pic\" alt = \"utente\"/>", $page);
    $page = str_replace("<log_in_out />", $log_in_out, $page);
    
    echo $page;
?>