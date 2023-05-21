<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include_once ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";
    require ".." . DIRECTORY_SEPARATOR . "db-conn.php";


    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["prev_page"] = $article_ref . "?article=" . $_GET["article"];

    $page = file_get_contents($html_path . "article.html");

    // IDENTIFICATION SECTION
   if (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != "guest") {
        $page = str_replace("<greet/>", "Ciao, ", $page);
        $page = str_replace("<user-img/>", $icon_user_ref, $page);
    } else {
        $page = str_replace("<greet/>", "", $page);
        $page = str_replace("<user-img/>", "", $page);
    }
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    //$_GET["article"] ritorna l'id dell articolo
    //quindi sarà: http://localhost/php/pages/article.php?articolo=[id]
    if(isset($_GET["article"])){
        $articleId = clearInput($_GET["article"]);
        $query = 'SELECT * FROM articolo WHERE id = "'. $articleId . '";';
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
        $articlePlace = $result["luogo"];
        $articleContent = $result["contenuto"];
        $articleImageAlt = $result["alt"];

        //Sostituisco i placeholder con i valori dell'articolo
        $page = str_replace("<article-id/>",$_GET["article"],$page);
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
        $query = 'SELECT nome FROM view_articolo_utente WHERE id = "'. $_GET["article"] . '";';
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
        $query = 'SELECT animale FROM articolo_animale WHERE articolo = "'. $_GET["article"] . '";';
        $queryResult = mysqli_query($mysqli, $query);

        $tmp = "";

         if($queryResult){
            //Se ci sono animali collegati all'articolo li aggiungo alla lista
            while($result = mysqli_fetch_assoc($queryResult)){
                $tmp .= $result["animale"];
            }
         }

         //Sostituisco il placeholder con la lista di animali collegati
         $page = str_replace("<article-animals/>",$animalsRelated,$page);
         $page = str_replace("<related-animal/>",$tmp,$page);
         $queryResult->free();
        
        //TODO: Sezione commenti
        $commentTemplate = file_get_contents($modules_path . "comment-template.html");
        $replyTemplate = file_get_contents($modules_path . "reply-template.html");

        $query = 'SELECT * FROM view_articolo_commento WHERE articolo = "'. $_GET["article"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        $commentList = "";
        while($commentResult = mysqli_fetch_assoc($queryResult)){
            $comment = $commentTemplate;
            $commentId = $commentResult["commento"];
            $commentText = $commentResult["contenuto"];
            $commentAuthor = $commentResult["nome"];
            $commentTimestamp = $commentResult["data"];
            $queryReply = 'SELECT * FROM view_articolo_commento_risposta WHERE commento = "' . $commentId . '";';
            $replyResult = mysqli_query($mysqli, $queryReply);
            $replyList = "";
            while($resultReply = mysqli_fetch_assoc($replyResult)){
                $reply = $replyTemplate;
                $replyText = $resultReply["contenuto_risposta"];
                $replyAuthor = $resultReply["nome_risposta"];
                $replyTimestamp = $resultReply["data_risposta"];
                $reply = str_replace("<reply-author/>",$replyAuthor, $reply);
                $reply = str_replace("<reply-timestamp/>",$replyTimestamp,$reply);
                $reply = str_replace("<reply-text/>",$replyText,$reply);
                $replyList .= $reply;
            }
            $comment = str_replace("<reply-list/>",$replyList, $comment);
            $comment = str_replace("<comment-id/>",$commentId, $comment);
            $comment = str_replace("<article-id/>",$_GET["article"],$comment);
            $comment = str_replace("<author/>",$commentAuthor,$comment);
            $comment = str_replace("<comment-text/>",$commentText,$comment);
            $comment = str_replace("<timestamp/>",$commentTimestamp,$comment);

            $commentList .= $comment;
        }
        $page = str_replace("<comment-list/>",$commentList,$page);
        $queryResult->free();
    }
    $mysqli->close();
    echo $page;
?>