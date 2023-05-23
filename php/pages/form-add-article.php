<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-add-article.html");

    if ($_SESSION['ruolo'] != 'admin' && $_SESSION['ruolo'] != 'writer') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }
    
    $_SESSION["prev_page"] =  $faar_ref;


    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);


    if(isset($_SESSION["submit-result"]))
    {
        $errorStrings = $_SESSION["error-strings"];
        $page = str_replace("<error-title/>",$errorStrings["titolo"], $page);
        $page = str_replace("<error-subtitle/>",$errorStrings["sottotitolo"], $page);
        $page = str_replace("<error-tag/>",$errorStrings["tag"], $page);
        $page = str_replace("<error-place/>",$errorStrings["luogo"], $page);
        $page = str_replace("<error-text/>",$errorStrings["testo"], $page);
        $page = str_replace("<error-img/>",$errorStrings["path"], $page);
        $page = str_replace("<error-animal/>",$errorStrings["creatura"], $page);
        unset($_SESSION["submit-result"]);
    }
    else
    {
        $page = str_replace("<error-title/>","", $page);
        $page = str_replace("<error-subtitle/>","", $page);
        $page = str_replace("<error-tag/>","", $page);
        $page = str_replace("<error-place/>","", $page);
        $page = str_replace("<error-text/>","", $page);
        $page = str_replace("<error-img/>","", $page);
        $page = str_replace("<error-animal/>","", $page);
    }

    /*
    $who_am_i = "<a href='admin-home.php' tabindex='3'> Amministrazione</a> ●" ;

    if ($_SESSION["ruolo"] == "admin") {
        $page = str_replace("<who-am-i/>", $who_am_i, $page);
    } else {
        $page = str_replace("<who-am-i/>", "" , $page);
    }*/
    
    echo $page;
?>