<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $errorStrings = [
        "nome" => "",
        "descrizione" => "",
        "status" => "",
        "data" => "",
        "path" => ""
    ]; 
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $nome = clearInput($_POST['name']);
        $status = clearInput($_POST['status']);
        $descrizione = clearInput($_POST['description']);
        $dataScoperta = clearInput($_POST['date']);
        $path = clearInput($_POST['image-path']);

        $ok = true;

        //controllo che il nome non sia vuoto e che contenga solo lettere o spazi
        if(strlen($nome) == 0){
            $errorStrings["nome"] = "Inserire un nome per la creatura";
            $ok = false;
        }
        else if(!preg_match('/^[\wèàìòéùç\s]*$/', $nome)){
            $errorStrings["nome"] = "Il nome della creatura non può contenere caratteri speciali";
            $ok = false;
        }
        
        //controllo che la descrizione sia lunga almeno 20 caratteri
        if(strlen($descrizione) < 20){
            $errorStrings["descrizione"] = "La descrizione deve essere lunga almeno 20 caratteri";
            $ok = false;
        }

        //controllo che lo status sia uno di quelli validi
        if (array_search(ucfirst($status),["Scoperto","Avvistato","Ipotizzato"],true) === false){
            $errorStrings["status"] = "Lo status deve essere valido";
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
            $errorStrings["path"] = "Non è stata caricata alcuna immagine";
            $ok = false;
        }
        
        $sql = "SELECT * FROM animale WHERE LOWER(nome) = LOWER('$nome')";
        $query = mysqli_query($mysqli, $sql);

        //controllo che l'animale non sia già presente nel database
        if (mysqli_num_rows($query) > 0) {
            $_SESSION["submit-result"] = "<p class='error'>Si ha tentato di inserire una creatura già presente</p>";
            $ok = false;
        }else if(!$ok){
            $_SESSION["submit-result"] = "<p class='error'>Errore nell'inserimento dell'animale</p>";
        }

        $query->free();
        
        //se tutti i controlli sono andati a buon fine inserisco l'animale nel database
        if($ok){
            $nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
            $descrizione = filter_var($descrizione, FILTER_SANITIZE_SPECIAL_CHARS);
            //$path = filter_var($path, FILTER_SANITIZE_ENCODED);

            $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`) VALUES ('$nome', '$descrizione', '$status', '$dataScoperta', '$path')";

            $query = mysqli_query($mysqli, $sql);

            if ($query) {
                $_SESSION["submit-result"] = "<p class='success'>Creatura inserita con successo</p>";
            }
        }

        $mysqli->close();

        $SESSION["error-strings"] = $errorStrings;
        header("Location: " . $_SESSION["prev_page"]);
    }