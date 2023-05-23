<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-add-animal.html");

    if ($_SESSION['ruolo'] != 'admin') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }

    $_SESSION["prev_page"] =  $faan_ref;


    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    if(isset($_SESSION["submit-result"]))
    {
        $errorStrings = $_SESSION["error-strings"];
        $page = str_replace("<result/>",$_SESSION["submit-result"], $page);
        $page = str_replace("<error-name/>",$errorStrings["nome"], $page);
        $page = str_replace("<error-desc/>",$errorStrings["descrizione"], $page);
        $page = str_replace("<error-status/>",$errorStrings["status"], $page);
        $page = str_replace("<error-date/>",$errorStrings["data"], $page);
        $page = str_replace("<error-img/>",$errorStrings["path"], $page);
        unset($_SESSION["submit-result"]);
    }
    else
    {
        $page = str_replace("<result/>","", $page);
        $page = str_replace("<error-name/>","", $page);
        $page = str_replace("<error-desc/>","", $page);
        $page = str_replace("<error-status/>","", $page);
        $page = str_replace("<error-date/>","", $page);
        $page = str_replace("<error-img/>","", $page);
    }
    
    echo $page;
?>