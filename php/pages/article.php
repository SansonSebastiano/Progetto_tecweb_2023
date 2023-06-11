<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";


    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["prev_page"] = $article_ref . "?article=" . $_GET["article"];

    $page = file_get_contents($html_path . "article.html");

    
   if (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != "guest") {
        $page = str_replace("<greet/>", "Ciao, ", $page);
        $page = str_replace("<user-img/>", $icon_user_ref, $page);
    } else {
        $page = str_replace("<greet/>", "", $page);
        $page = str_replace("<user-img/>", "", $page);
    }
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    
    
    if(isset($_GET["article"])){
        $articleId = clearInput($_GET["article"]);
        $query = 'SELECT * FROM articolo WHERE id = "'. $articleId . '";';
        $queryResult = mysqli_query($mysqli, $query);

        $result = mysqli_fetch_assoc($queryResult);
        if(!$result){
            $mysqli->close();
            header("Location: " . $html_ref . "404.html");
            exit();
        }
        
        

        $articleTitle = $result["titolo"];
        $articleSubTitle = $result["descrizione"];
        $articleTag = $result["tag"];
        $articleDate = $result["data"];
        $articleImage = $result["image_path"];
        $articlePlace = $result["luogo"];
        $articleContent = $result["contenuto"];
        $articleImageAlt = $result["alt"];

        
        $page = str_replace("<article-id/>",$_GET["article"],$page);
        $page = str_replace("<article-title/>",$articleTitle,$page);
        $page = str_replace("<article-subtitle/>",$articleSubTitle,$page);
        $page = str_replace("<article-tag/>",$articleTag,$page);
        $page = str_replace("<article-date/>",$articleDate,$page);
        $page = str_replace("<article-image/>",$articleImage,$page);
        $page = str_replace("<article-image-alt/>",$articleImageAlt,$page);
        $page = str_replace("<article-place/>",$articlePlace,$page);
        $page = str_replace("<article-content/>",$articleContent,$page);

        $queryResult->free_result();

        
        $query = 'SELECT nome_animale FROM articolo WHERE id = "'. $_GET["article"] . '";';
        $queryResult = mysqli_query($mysqli, $query);

        $tmp = "";

        if($queryResult){
            $result = mysqli_fetch_assoc($queryResult);
            $page = str_replace("<related-animal/>",$result["nome_animale"],$page);
        }

        
        $queryResult->free_result();
        
        
        $commentTemplate = file_get_contents($modules_path . "comment-template.html");
        $replyTemplate = file_get_contents($modules_path . "reply-template.html");

        if ($_SESSION["ruolo"] == "guest") {
            $page = str_replace("<to-hide/>", "hidden", $page);
            $commentTemplate = str_replace("<to-hide/>", "hidden", $commentTemplate);
        } else {
            $page = str_replace("<to-hide/>", "", $page);
            $commentTemplate = str_replace("<to-hide/>", "", $commentTemplate);
        }

        $query = 'SELECT * FROM view_articolo_commento WHERE articolo = "'. $_GET["article"] . '" AND commento NOT IN (SELECT figlio FROM view_articolo_commento_risposta) ;';
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
        $queryResult->free_result();
    }
    $mysqli->close();
    echo $page;
?>