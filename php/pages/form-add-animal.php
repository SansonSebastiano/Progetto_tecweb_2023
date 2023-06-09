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
    

    $errNome = [0 => "", 1 => "Inserire un nome per la creatura", 2 => "Il nome della creatura non può contenere caratteri speciali"];
    $errDesc = [0 => "", 1 => "La descrizione deve essere lunga almeno 20 caratteri"];
    $errStatus = [0 => "", 1 => "Lo status deve essere valido"];
    $errData =  [0 => "", 1 => "Inserire una data", 2 => "La data deve essere nel formato corretto"];
    $errImg = [0 => "", 1 => "Non è stata caricata alcuna immagine"];
    $errSubmit =   [0 => "",
                    1 => "<p class='success'><strong>Creatura inserita con successo</strong></p>", 
                    2 => "<p class='error'><strong>Errore nell'inserimento della creatura</strong></p>",
                    3 => "<p class='error'><strong>Si ha tentato di inserire una creatura già presente</strong></p>"];


    if(isset($_SESSION["error-codes"]))
    {
        $ec = $_SESSION["error-codes"];
        $page = str_replace("<result/>",$errSubmit[$ec["submit"]], $page);
        $page = str_replace("<error-name/>",$errNome[$ec["nome"]], $page);
        $page = str_replace("<error-desc/>",$errDesc[$ec["descrizione"]], $page);
        $page = str_replace("<error-status/>",$errStatus[$ec["status"]], $page);
        $page = str_replace("<error-date/>",$errData[$ec["data"]], $page);
        $page = str_replace("<error-img/>",$errImg[$ec["path"]], $page);
        unset($_SESSION["error-codes"]);
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