<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

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
            $errorStrings["tag"] = "Inserisci un tag valido";
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

        if(!preg_match('/^[a-zA-Z_èàìòéùç\s]*$/', $creatura)){
            $errorStrings["creatura"] = "Il nome dell'animale riferito dall'articolo non può contenere caratteri speciali";
            $ok = false;
        }

        if($ok){
            if(strlen($creatura) > 0)
            {
                $animal = "SELECT * FROM animale WHERE nome = '$creatura'";
                $queryResult = mysqli_query($mysqli,$animal);
                if($queryResult->num_rows == 0){

                    $queryResult->free();
                    $_SESSION["result"] = "<p class='error'>L'animale riferito non è stato trovato</p>";

                }else{   
                    $queryResult->free();
                    $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`nome_animale`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', 0, '$creatura')";
                    $queryResult = mysqli_query($mysqli,$sql);

                    $_SESSION["result"] = "<p class='success'>Articolo inserito con successo</p>";
                }
            }
            else
            {
                $queryResult->free();
                $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`nome_animale`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', 0, NULL)";
                $queryResult = mysqli_query($mysqli,$sql);
            }

        }else{
            $_SESSION["result"] = "<p class='error'>Errore nell'inserimento dell'articolo</p>";
        }

        $mysqli->close();

        $SESSION["error-strings"] = $errorStrings;
        header("Location: " . $_SESSION["prev_page"]);
    }