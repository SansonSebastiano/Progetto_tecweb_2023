<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["prev_page"] = $article_ref;

    $page = file_get_contents($html_path . "article.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    //$_GET["articolo"] ritorna l'id dell articolo
    //quindi sarà: http://localhost/php/pages/article.php?articolo=[id]
    if(isset($_GET["articolo"])){
        $query = 'SELECT * FROM articolo WHERE id = "'. $_GET["articolo"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        if(!$queryResult){
            include_once($html_path . "404.html");
            exit();
        }

        $result = mysqli_fetch_assoc($queryResult);

        if(!$result){
            include_once($html_path . "404.html");
            exit();
        }
        
        $queryResult->free();

        //Mi ricavo le informazioni principali dell'articolo
        $articleTitle = $result["titolo"];
        $articleSubTitle = $result["descrizione"];
        $articleTag = $result["tag"];
        $articleDate = $result["data"];
        $articleImage = $result["image_path"];
        $articleImageAlt = $result["alt"];
        $articlePlace = $result["luogo"];
        $articleContent = $result["contenuto"];

        //Sostituisco i placeholder con i valori dell'articolo
        $page = str_replace("<article-title/>",$articleTitle,$page);
        $page = str_replace("<article-subtitle/>",$articleSubTitle,$page);
        $page = str_replace("<article-tag/>",ucfirst($articleTag),$page);
        $page = str_replace("<article-date/>",$articleDate,$page);
        $page = str_replace("<article-image/>",$articleImage,$page);
        $page = str_replace("<article-image-alt/>",$articleImageAlt,$page);
        $page = str_replace("<article-place/>",$articlePlace,$page);
        $page = str_replace("<article-content/>",$articleContent,$page);
        
        //Scelgo la classe css da applicare in base al tag dell'articolo e sostituisco il placeholder
        $cssTags = [
            "scoperta" => "discovery",
            "avvistamento" => "sighting",
            "comunicazione" => "comunication",
            "new-entry" => "new-entry"
        ];
        $page = str_replace("<tag-type/>",$cssTags[$articleTag],$page);

        //Mi ricavo l'autore dell'articolo
        $query = 'SELECT nome FROM view_articolo_utente WHERE id = "'. $_GET["articolo"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        
        $result = mysqli_fetch_assoc($queryResult);
        
        $author = "";
        
        //Se l'articolo è stato scritto da un utente cancellato
        if(!$queryResult){
            $author = "Anonimo";
        }else{ 
            //Se l'articolo è stato scritto da un utente esistente
            $author = $result["nome"];
        }

        //Sostituisco il placeholder con il nome dell'autore
        $page = str_replace("<article-author/>",$author,$page);

        $queryResult->free();

        //Mi ricavo gli animali collegati all'articolo
        $query = 'SELECT animale FROM articolo_animale WHERE articolo = "'. $_GET["articolo"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        $animalsRelated = "";
         if($queryResult){
            //Se ci sono animali collegati all'articolo li aggiungo alla lista
            while($result = mysqli_fetch_assoc($queryResult)){
                $animalsRelated .= "<dd>" . $result["animale"] . "</dd>";
            }
         }else{
            //Se non ci sono animali collegati all'articolo mostro un messaggio
            $animalsRelated = "<dd>Nessun animale collegato</dd>";
         }

         //Sostituisco il placeholder con la lista di animali collegati
         $page = str_replace("<article-animals/>",$animalsRelated,$page);
         
         $queryResult->free();
         

         //TODO: Sezione commenti
        }
    // }else{
    //     header("Location: ../../index.php");
    // }

    echo $page;
?>