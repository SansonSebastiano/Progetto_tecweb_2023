<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "check_conn.php");

    session_start();

    if ($_SESSION['ruolo'] != 'admin') {
        echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: ../../index.php");
    }
    $_SESSION["prev_page"] = "./pages/form-add-animal.php";

    $page = file_get_contents(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "form-add-animal.html");

    $page = str_replace("<user />", "Ciao, " . $_SESSION["username"], $page);
    $page = str_replace("<userImg />", "<img src=\"../../images/icons/icon-user.png\" class = \"profile-pic\" alt = \"utente\"/>", $page);
    $page = str_replace("<log_in_out />", $log_in_out, $page);
    
    echo $page;
?>