<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-add-article.html");

    include $php_path . "template-loader.php";

    if ($_SESSION['ruolo'] != 'admin' && $_SESSION['ruolo'] != 'writer') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }
    
    $_SESSION["prev_page"] =  $faar_ref;

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    $errTitolo = [0 => "", 1 => "Inserire un titolo per l'articolo", 2 => "Il titolo dell'articolo non può contenere caratteri speciali"];
    $errSub = [0 => "", 1 => "Inserisci un sottotitolo"];
    $errTag = [0 => "", 1 => "Inserisci un tag valido"];
    $errTesto =  [0 => "", 1 => "Il testo dell'articolo deve essere lungo almeno 20 caratteri"];
    $errImg = [0 => "", 1 => "Non è stata caricata alcuna immagine"];
    $errAnimal = [0 => "", 1 => "Il nome dell'animale riferito dall'articolo non può contenere caratteri speciali"];
    $errSubmit =   [0 => "",
                    1 => "<p class='success'><strong>Articolo inserito con successo</strong></p>", 
                    2 => "<p class='error'><strong>Errore nell'inserimento dell'articolo</strong></p>",
                    3 => "<p class='error'><strong>L'animale riferito non è stato trovato</strong></p>"];
                    
    if(isset($_SESSION["error-codes"]))
    {
        $ec = $_SESSION["error-codes"];
        $page = str_replace("<result/>",$errSubmit[$ec["submit"]], $page);
        $page = str_replace("<error-title/>",$errTitolo[$ec["titolo"]], $page);
        $page = str_replace("<error-subtitle/>",$errSub[$ec["sottotitolo"]], $page);
        $page = str_replace("<error-tag/>",$errTag[$ec["tag"]], $page);
        $page = str_replace("<error-text/>",$errTesto[$ec["testo"]], $page);
        $page = str_replace("<error-img/>",$errImg[$ec["path"]], $page);
        $page = str_replace("<error-animal/>",$errAnimal[$ec["creatura"]], $page);
        unset($_SESSION["error-codes"]);
    }
    else
    {
        $page = str_replace("<result/>","", $page);
        $page = str_replace("<error-title/>","", $page);
        $page = str_replace("<error-subtitle/>","", $page);
        $page = str_replace("<error-tag/>","", $page);
        $page = str_replace("<error-place/>","", $page);
        $page = str_replace("<error-text/>","", $page);
        $page = str_replace("<error-img/>","", $page);
        $page = str_replace("<error-animal/>","", $page);
    }

    
    $who_am_i = "<a href='admin-home.php' tabindex='0'> Amministrazione</a> ●" ;

    if ($_SESSION["ruolo"] == "admin") {
        $page = str_replace("<who-am-i/>", $who_am_i, $page);
    } else {
        $page = str_replace("<who-am-i/>", "" , $page);
    }
    
    echo $page;
?>