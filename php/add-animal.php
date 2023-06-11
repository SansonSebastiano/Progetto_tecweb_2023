<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $errorCodes = [
        "nome" => 0,
        "descrizione" => 0,
        "status" => 0,
        "data" => 0,
        "path" => 0,
        "submit" => 0
    ];
    $errorFlag = False;
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $nome = clearInput($_POST['name']);
        $status = clearInput($_POST['status']);
        $descrizione = clearInput($_POST['description']);
        $dataScoperta = clearInput($_POST['date']);
        $path = clearInput($_POST['image-path']);


        
        if(strlen($nome) == 0){
            $errorCodes["nome"] = 1;
            $errorFlag = True;
        }
        else if(!preg_match('/^[\wèàìòéùç\s]*$/', $nome)){
            $errorCodes["nome"] = 2;
            $errorFlag = True;
        }
        
        
        if(strlen($descrizione) < 20){
            $errorCodes["descrizione"] = 1;
            $errorFlag = True;
        }

        
        if (array_search(ucfirst($status),["Scoperto","Avvistato","Ipotizzato"],true) === false){
            $errorCodes["status"] = 1;
            $errorFlag = True;        
        }
        
        
        if (strlen($dataScoperta) == 0){
            $errorCodes["data"] = 1;
            $errorFlag = True;   
        }
        else if(!preg_match("/\d{4}\-\d{2}\-\d{2}/", $dataScoperta)){ 
            $errorCodes["data"] = 2;
            $errorFlag = True;   
        }

        
        if (strlen($path) == 0){
            $errorCodes["path"] = 1;
            $errorFlag = True; 

        }
        
        $sql = "SELECT * FROM animale WHERE LOWER(nome) = LOWER('$nome')";
        $query = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($query) > 0) {
            $errorCodes["submit"] = 3;
            $errorFlag = True; 
        }
        
        
        if(!$errorFlag){
            $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $descrizione = filter_var($descrizione, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $alt = "Immagine della creatura: " . $nome;
            
            $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$dataScoperta', '$path', '$alt');";

            $query = mysqli_query($mysqli, $sql);

            $errorCodes["submit"] = $query ? 1 : 2;
        }

        $mysqli->close();

        $_SESSION["error-codes"] = $errorCodes;
        header("Location: " . $_SESSION["prev_page"]);
    }