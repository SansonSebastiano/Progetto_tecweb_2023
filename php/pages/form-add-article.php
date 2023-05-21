<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin' && $_SESSION['ruolo'] != 'writer') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }
    
    $_SESSION["prev_page"] =  $faar_ref;

    $result = "";

    $errorStrings = [
        "titolo" => "",
        "sottotitolo" => "",
        "tag" => "",
        "luogo" => "",
        "data" => "",
        "testo" => "",
        "path" => "",
        "creatura" => ""
    ];

    $page = file_get_contents($html_path . "form-add-article.html");

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $titolo = clearInput(filter_input(INPUT_POST,"titolo",FILTER_SANITIZE_SPECIAL_CHARS));
        $sottotitolo = clearInput(filter_input(INPUT_POST,"sottotitolo",FILTER_SANITIZE_SPECIAL_CHARS));
        $tag = clearInput($_POST['tag']);
        $luogo = clearInput(filter_input(INPUT_POST,"luogo",FILTER_SANITIZE_SPECIAL_CHARS));
        $testo = clearInput(filter_input(INPUT_POST,"testo",FILTER_SANITIZE_SPECIAL_CHARS));
        $autore = $_SESSION['id'];
        $path = clearInput($_POST['image-path']);
        $creatura = clearInput(filter_input(INPUT_POST,"creatura",FILTER_SANITIZE_SPECIAL_CHARS));

        $ok = true;

        if(strlen($titolo) == 0){
            $errorStrings["titolo"] = "Inserire un titolo per l'articolo";
            $ok = false;
        }
        else if(!preg_match('/^[\wèàìòéùç\s]*$/', $titolo)){
            $errorStrings["titolo"] = "Il titolo dell'articolo non può contenere caratteri speciali";
            $ok = false;
        }

        if(strlen($sottotitolo) == 0){
            $errorStrings["sottotitolo"] = "Inserisci un sottotitolo";
            $ok = false;
        }

        if (array_search($tag,['scoperta','new-entry','avvistamento','comunicazione','none'],true) === false){
            $errorStrings["tag"] = "Inserito un tag invalido";
            $ok = false;
        }
    

        if(strlen($testo) < 20 || strlen($testo) > 2000){
            $errorStrings["testo"] = "Il testo dell'articolo deve essere lungo almeno 20 caratteri e non deve superare i 2000 caratteri";
            $ok = false;
        }

        if (strlen($path) == 0){
            $errorStrings["path"] = "Non è stata caricata nessuna immagine";
            $page = str_replace("<img-status/>", "error", $page);
            $ok = false;
        }else{
            $page = str_replace("<img-status/>", "success", $page);
        }

        if(strlen($creatura) == 0){
            $errorStrings["creatura"] = "Inserire un nome per l'animale riferito dall'articolo";
            $ok = false;
        }
        else if(!preg_match('/^[a-zA-Z_èàìòéùç\s]*$/', $creatura)){
            $errorStrings["creatura"] = "Il nome dell'animmale riferito dall'articolo non può contenere caratteri speciali";
            $ok = false;
        }


        if($ok){

            $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`alt`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', 0, '$testo')";
            $queryResult = mysqli_query($mysqli, $sql);
            $id_query = "SELECT MAX(`id`) FROM `articolo`";
            $queryResult = mysqli_query($mysqli,$id_query);
            $data = mysqli_fetch_array($queryResult);
            $id = $data[0];

            if ($queryResult) {
                // free the result set
                $queryResult->free();
            }
            //TODO: inserire articolo_animale
            $animal = "SELECT * FROM animale WHERE nome = '$creatura'";
            $queryResult = mysqli_query($mysqli,$animal);
            if($queryResult->num_rows == 0){

                $queryResult->free();
                $result = "<p class='error'>L'animale riferito non è stato trovato</p>";

            }else{
                
                $queryResult->free();
                $sql = "INSERT INTO `articolo_animale` (`articolo`,`animale`) VALUES ('$id', '$creatura')";
                $queryResult = mysqli_query($mysqli,$sql);

                $result = "<p class='success'>Articolo inserito con successo!</p>";
            }

        }else{
            $result = "<p class='error'>Errore nell'inserimento dell'articolo</p>";
        }
    }else if($_SERVER['REQUEST_METHOD'] == "GET"){
        $page = str_replace("<img-status/>", "success", $page);
    }

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"] ?? "ospite", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    $page = str_replace("<result/>", $result, $page);

    $page = str_replace("<error-title/>", $errorStrings["titolo"], $page);
    $page = str_replace("<error-subtitle/>", $errorStrings["sottotitolo"], $page);
    $page = str_replace("<error-tag/>", $errorStrings["tag"], $page);
    $page = str_replace("<error-place/>", $errorStrings["luogo"], $page);
    $page = str_replace("<error-text/>", $errorStrings["testo"], $page);
    $page = str_replace("<error-img/>", $errorStrings["path"], $page);
    $page = str_replace("<error-animal/>", $errorStrings["creatura"], $page);


    $who_am_i = "<a href='admin-home.php' tabindex='3'> Amministrazione</a> ●" ;

    if ($_SESSION["ruolo"] == "admin") {
        $page = str_replace("<who-am-i/>", $who_am_i, $page);
    } else {
        $page = str_replace("<who-am-i/>", "" , $page);
    }
    
    echo $page;
?>