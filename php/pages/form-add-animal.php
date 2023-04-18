<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    session_start();

    if ($_SESSION['ruolo'] != 'admin') {
        //echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
    }
    $_SESSION["prev_page"] =  DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-animal.php";

    $page = file_get_contents(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "form-add-animal.html");

    $page = str_replace("<user />", "Ciao, " . $_SESSION["username"], $page);
    $icon_user = "<img src=\"" . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "icon-user.png" . "\" class = \"profile-pic\" alt = \"utente\"/>";
    $page = str_replace("<user-img />", $icon_user, $page);
    $page = str_replace("<log-in-out />", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    
    echo $page;
?>