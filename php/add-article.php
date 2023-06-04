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

        $titolo = clearInput($_POST['titolo']);
        $sottotitolo = clearInput($_POST['sottotitolo']);
        $tag = clearInput($_POST['tag']);
        $luogo = clearInput($_POST['luogo']);
        $testo = clearInput($_POST['testo']);
        $autore = $_SESSION['id'];
        $path = clearInput($_POST['image-path']);
        $creatura = clearInput($_POST['creatura']);
        $featured = isset($_POST['featured']) ? 1 : 0;

        $ok = true;

        if(strlen($titolo) == 0){
            $errorStrings["titolo"] = "Inserire un titolo per l'articolo";
            $ok = false;
        }
        else if(!preg_match('/^[\wèàìòéùç\s]*$/', $titolo)){
            $errorStrings["titolo"] = "Il titolo dell'articolo non può contenere caratteri speciali";
            $ok = false;
        }else{
            $errorStrings["titolo"] = "";
        }

        if(strlen($sottotitolo) == 0){
            $errorStrings["sottotitolo"] = "Inserisci un sottotitolo";
            $ok = false;
        }else{
            $errorStrings["sottotitolo"] = "";
        }

        if (array_search($tag,['scoperta','new-entry','avvistamento','comunicazione','none'],true) === false){
            $errorStrings["tag"] = "Inserisci un tag valido";
            $ok = false;
        }else{
            $errorStrings["tag"] = "";
        }
    

        if(strlen($testo) < 20 ){
            $errorStrings["testo"] = "Il testo dell'articolo deve essere lungo almeno 20 caratteri";
            $ok = false;
        }else{
            $errorStrings["testo"] = "";
        }

        if (strlen($path) == 0){
            $errorStrings["path"] = "Inserire un immagine dell'articolo";
            $page = str_replace("<img-status/>", "error", $page);
            $ok = false;
        }else{
            $errorStrings["path"] = "";
            $page = str_replace("<img-status/>", "success", $page);
        }

        if(!preg_match('/^[a-zA-Zèàìòéùç\s]*$/', $creatura)){
            $errorStrings["creatura"] = "Il nome dell'animale riferito dall'articolo non può contenere caratteri speciali";
            $ok = false;
        }else{
            $errorStrings["creatura"] = "";
        }

        $titolo = filter_var($titolo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sottotitolo = filter_var($sottotitolo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $luogo = filter_var($luogo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $testo = filter_var($testo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$path = filter_var($path, FILTER_SANITIZE_ENCODED);
        $creatura = filter_var($creatura, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($ok){
            if(strlen($creatura) > 0)
            {
                $animal = "SELECT * FROM animale WHERE nome = '$creatura'";
                $queryResult = mysqli_query($mysqli,$animal);
                if($queryResult->num_rows == 0){

                    $queryResult->free();
                    $_SESSION["submit-result"] = "<p class='error'>L'animale riferito non è stato trovato</p>";

                }else{   
                    $queryResult->free();
                    $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`nome_animale`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', '$featured', '$creatura')";
                    $queryResult = mysqli_query($mysqli,$sql);

                    $_SESSION["submit-result"] = "<p class='success'>Articolo inserito con successo</p>";
                }
            }
            else
            {


                $queryResult->free();
                $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`nome_animale`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', '$featured', NULL)";
                $queryResult = mysqli_query($mysqli,$sql);

                $_SESSION["submit-result"] = "<p class='success'>Articolo inserito con successo</p>";
            }

        }else{
            $_SESSION["submit-result"] = "<p class='error'>Errore nell'inserimento dell'articolo</p>";
        }

        $mysqli->close();

        $_SESSION["error-strings"] = $errorStrings;
        header("Location: " . $_SESSION["prev_page"]);
    }