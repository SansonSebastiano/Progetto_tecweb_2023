<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $result = "";

    $page = file_get_contents($html_path . "form-add-animal.html");

    if ($_SESSION['ruolo'] != 'admin') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }

    $errorStrings = [
        "nome" => "",
        "descrizione" => "",
        "status" => "",
        "data" => "",
        "path" => ""
    ]; 
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $nome = clearInput(filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS));
        $status = clearInput($_POST['status']);
        $descrizione = clearInput(filter_input(INPUT_POST,"description",FILTER_SANITIZE_SPECIAL_CHARS));
        $dataScoperta = clearInput($_POST['data-scoperta']);
        $path = clearInput($_POST['image-path']);

        $sql = "SELECT * FROM animale WHERE nome = '$nome'";
        $ok = true;
        $query = mysqli_query($mysqli, $sql);

        //controllo che il nome non sia vuoto e che contenga solo lettere o spazi
        if(strlen($nome) == 0){
            $errorStrings["nome"] = "Inserire un nome per l'animale";
            $ok = false;
        }
        else if(!preg_match('/^[\wèàìòéùç\s]*$/', $nome)){
            $errorStrings["nome"] = "Il nome dell'animale non può contenere caratteri speciali";
            $ok = false;
        }
        
        //controllo che la descrizione sia lunga almeno 20 caratteri
        if(strlen($descrizione) < 20 || strlen($descrizione) > 2000){
            $errorStrings["descrizione"] = "La descrizione deve essere lunga almeno 20 caratteri e non deve superare i 2000 caratteri";
            $ok = false;
        }

        //controllo che lo status sia uno di quelli validi
        if (array_search(ucfirst($status),["Scoperto","Avvistato","Ipotizzato"],true) === false){
            $errorStrings["status"] = "Lo status deve essere uno di quelli validi";
            $ok = false;
        }
        
        //controllo che la data non sia vuota e che sia nel formato corretto
        if (strlen($dataScoperta) == 0){
            $errorStrings["data"] = "Inserire una data";
            $ok = false;
        }
        else if(!preg_match("/\d{4}\-\d{2}\-\d{2}/", $dataScoperta)){ //se la data non è nel formato corretto (anno - mese - giorno)
            $errorStrings["data"] = "La data non è nel formato corretto";
            $ok = false;
        } 

        //controllo che sia stata caricata un immagine
        if (strlen($path) == 0){
            $errorStrings["path"] = "Non è stata caricata nessuna immagine";
            $page = str_replace("<img-status/>", "error", $page);
            $ok = false;
        }else{
            $page = str_replace("<img-status/>", "success", $page);
        }

        //controllo che l'animale non sia già presente nel database
        if (mysqli_num_rows($query) > 0) {
            $result = "<p class='error'>Animale già presente!</p>";
            $ok = false;
        }else if(!$ok){
            $result = "<p class='error'>Errore nell'inserimento dell'animale!</p>";
        }

        $query->free();
        
        //se tutti i controlli sono andati a buon fine inserisco l'animale nel database
        if($ok){
        
        $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$dataScoperta', '$path', '$nome')";

        $query = mysqli_query($mysqli, $sql);

        if ($query) {
            // free the result set
            //$query->free();
            $result = "<p class='success'>Animale inserito con successo!</p>";

            }
        }
    }

    $_SESSION["prev_page"] =  $faan_ref;


    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"] ?? "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    $page = str_replace("<result/>", $result, $page);

    $page = str_replace("<error-animal/>", $errorStrings["nome"], $page);
    $page = str_replace("<error-desc/>", $errorStrings["descrizione"], $page);
    $page = str_replace("<error-status/>", $errorStrings["status"], $page);
    $page = str_replace("<error-date/>", $errorStrings["data"], $page);
    $page = str_replace("<error-img/>", $errorStrings["path"], $page);
    
    
    echo $page;
?>