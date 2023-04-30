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
    $page = str_replace("<user/>", $_SESSION["username"], $page);
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

        $articleTitle = $result["titolo"];
        $articleSubTitle = $result["descrizione"];
        $articleTag = $result["tag"];
        $articleDate = $result["data"];
        $articleImage = $result["image_path"];
        $articleImageAlt = $result["alt"];
        $articlePlace = $result["luogo"];
        $articleContent = $result["contenuto"];

        $page = str_replace("<article-title/>",$articleTitle,$page);
        $page = str_replace("<article-subtitle/>",$articleSubTitle,$page);
        $page = str_replace("<article-tag/>",ucfirst($articleTag),$page);
        $page = str_replace("<article-date/>",$articleDate,$page);
        $page = str_replace("<article-image/>",$articleImage,$page);
        $page = str_replace("<article-image-alt/>",$articleImageAlt,$page);
        $page = str_replace("<article-place/>",$articlePlace,$page);
        $page = str_replace("<article-content/>",$articleContent,$page);

        $query = 'SELECT nome FROM view_articolo_utente WHERE id = "'. $_GET["articolo"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        
        $result = mysqli_fetch_assoc($queryResult);
        
        $author = "";
        
        if(!$queryResult){
            $author = "Anonimo";
        }else{
            $author = $result["nome"];
        }

        $page = str_replace("<article-author/>",$author,$page);
        
    }

    echo $page;
?>