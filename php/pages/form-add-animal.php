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
        //echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $nome = trim(clearInput(filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS)));
        $status = clearInput($_POST['status']);
        $descrizione = trim(clearInput(filter_input(INPUT_POST,"description",FILTER_SANITIZE_SPECIAL_CHARS)));
        $data = clearInput($_POST['data_scoperta']);
        $path = clearInput($_POST['image-path']);

        $sql = "SELECT * FROM animale WHERE nome = '$nome'";
        $ok = true;
        $query = mysqli_query($mysqli, $sql);

        if(preg_match('/^[\w\s]*$/', $nome)){
            $page = str_replace("<error-name/>", "Il nome dell animale può contenere solo lettere o spazi", $page);
            $ok = false;
        }else{
            $page = str_replace("<error-name/>", "", $page);
        }
        
        if(strlen($descrizione) < 20){
            $page = str_replace("<error-desc/>", "La descrizione deve contenere almeno 20 caratteri", $page);
            $ok = false;
        }else{
            $page = str_replace("<error-desc/>", "", $page);
        }
        
        if (strlen($data) == 0){
            $page = str_replace("<error-date/>", "La data di nascita non può essere vuota", $page);
            $ok = false;
        }
        else if(!preg_match("/\d{4}\-\d{2}\-\d{2}/", $data)){ //se la data non è nel formato corretto (anno - mese - giorno)
            $page = str_replace("<error-date/>", "La data non è nel formato corretto", $page);
            $ok = false;
        } else {
            $page = str_replace("<error-date/>", "", $page);
        }

        if (strlen($path) == 0){
            $page = str_replace("<error-img/>", "Non &egrave; stata caricata nessun immagine", $page);
            $page = str_replace("<img-status/>", "error", $page);
            $ok = false;
        }else{
            $page = str_replace("<error-img/>", "", $page);
            $page = str_replace("<img-status/>", "success", $page);
        }

        if (mysqli_num_rows($query) > 0) {
            $result = "<p class='error'>Animale già presente!</p>";
            $ok = false;
        }

        $query->free();
        
        if($ok){
        
        $query->free();
        $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path', '$nome')";

        $query = mysqli_query($mysqli, $sql);

        if ($query) {
            // free the result set
            //$query->free();
            $result = "<p class='success'>Animale inserito con successo!</p>";

            }
        }
    }else if($_SERVER['REQUEST_METHOD'] == "GET"){
        //se è stata fatta una richiesta GET svuota i messaggi di successo e di errore
        $page = str_replace("<error-desc/>", "", $page);
        $page = str_replace("<error-name/>", "", $page);
        $page = str_replace("<error-date/>", "", $page);
        $page = str_replace("<error-img/>", "", $page);
        $page = str_replace("<img-status/>", "success", $page);
    }

    $_SESSION["prev_page"] =  $faan_ref;


    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"] ?? "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    $page = str_replace("<result/>", $result, $page);
    
    echo $page;
?>