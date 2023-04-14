<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "check-conn.php");

    session_start();
    $_SESSION["prev_page"] = "./pages/animal-chart.php";

    $page = file_get_contents(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "animal-chart.html");

    $page = str_replace("<user />", "Ciao, " . $_SESSION["username"], $page);
    $page = str_replace("<user-img />", "<img src=\"../../images/icons/icon-user.png\" class = \"profile-pic\" alt = \"utente\"/>", $page);
    $page = str_replace("<log-in-out />", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    
    echo $page;
?>