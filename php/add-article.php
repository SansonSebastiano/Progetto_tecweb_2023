<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $errorCodes = [
        "titolo" => 0,
        "sottotitolo" => 0,
        "tag" => 0,
        "luogo" => 0,
        "testo" => 0,
        "path" => 0,
        "creatura" => 0,
        "submit" => 0
    ];
    $errorFlag = False;

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

        if(strlen($titolo) == 0){
            $errorCodes["titolo"] = 1;
            $errorFlag = True;
        }
        else if(!preg_match('/^[\wèàìòéùç\s]*$/', $titolo)){
            $errorCodes["titolo"] = 2;
            $errorFlag = True;
        }

        if(strlen($sottotitolo) == 0){
            $errorCodes["sottotitolo"] = 1;
            $errorFlag = True;
        }

        if (array_search($tag,['scoperta','new-entry','avvistamento','comunicazione','none'],true) === false){
            $errorCodes["tag"] = 1;
            $errorFlag = True;
        }

        if(strlen($testo) < 20){
            $errorCodes["testo"] = 1;
            $errorFlag = True;
        }

        if (strlen($path) == 0){
            $errorCodes["path"] = 1;
            $errorFlag = True;
        }

        if(!preg_match('/^[a-zA-Zèàìòéùç\s]*$/', $creatura)){
            $errorCodes["creatura"] = 1;
            $errorFlag = True;
        }

        $titolo = filter_var($titolo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sottotitolo = filter_var($sottotitolo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $luogo = filter_var($luogo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $testo = filter_var($testo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$path = filter_var($path, FILTER_SANITIZE_ENCODED);
        $creatura = filter_var($creatura, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$errorFlag){
            if(strlen($creatura) > 0)
            {
                $animal = "SELECT * FROM animale WHERE nome = '$creatura'";
                $queryResult = mysqli_query($mysqli,$animal);
                if($queryResult->num_rows == 0){

                    $errorCodes["submit"] = 3;

                }else{   
                    $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`nome_animale`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', '$featured', '$creatura')";
                    $queryResult = mysqli_query($mysqli,$sql);
                    $errorCodes["submit"] = $queryResult ? 1 : 2;
                }
            }
            else
            {
                $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`nome_animale`) VALUES ('$autore', '$titolo', NOW(), '$luogo', '$sottotitolo', '$testo', '$path', '$tag', '$featured', NULL)";
                $queryResult = mysqli_query($mysqli,$sql);

                $errorCodes["submit"] = $queryResult ? 1 : 2;
            }
        }

        $mysqli->close();

        $_SESSION["error-codes"] = $errorCodes;
        header("Location: " . $_SESSION["prev_page"]);
    }