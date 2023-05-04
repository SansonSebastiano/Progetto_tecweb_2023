<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_ref;

    $page = file_get_contents($html_path . "animal.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    if($_GET["animale"]){
        $query = 'SELECT * FROM animale WHERE nome = "'. $_GET["animale"] . '";';
        $queryResult = mysqli_query($connessione, $query);
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

        $animalName = $result["nome"];
        $description = $result["descrizione"];
        $image = $result["image_path"];
        $scoperta = $result["data_scoperta"];
        $status = $result["status"];

        $page = str_replace("<animal-name/>",$animalName,$page);

        $page = str_replace("<animal-description/>",$description,$page);

        $page = str_replace("<data-scoperta/>",$scoperta,$page);

        $page = str_replace("<animal-status/>",ucfirst($status),$page);

        $queryTwo = 'SELECT * FROM articolo JOIN articolo_animale ON articolo.id = articolo_animale.articolo WHERE animale = "'. $_GET["animale"] . '" ORDER BY articolo.data;';
        $queryResultTwo = mysqli_query($connessione, $queryTwo);

        $articleResult = mysqli_fetch_assoc($queryResultTwo);

        $articleTitle = $articleResult["titolo"];
        $articleDescription = $articleResult["descrizione"];
        $articleTag = $articleResult["tag"];
        $ultimoAvv = $articleResult["data"];

        $page = str_replace("<recent-title/>",$articleTitle,$page);

        $page = str_replace("<recent-description/>",$articleDescription,$page);

        $page = str_replace("<recent-tag/>",strtoupper($articleTag),$page);

        $page = str_replace("<ultimo-avvistamento/>",explode(" ",$ultimoAvv,2)[0],$page);

        $relArticleTemplate = file_get_contents($modules_path . "article-template.html");

        mysqli_data_seek($queryResultTwo,0);
        $relArticles = "";
        while($articleResult = mysqli_fetch_assoc($queryResultTwo)){
            $article = $relArticleTemplate;
            $articleTitle = $articleResult["titolo"];
            $articleId = $articleResult["id"];
            $articleTag = $articleResult["tag"];
            
            $article = str_replace("<article-tag/>",$articleTag,$article);
            
            $cssTags = [
                "scoperta" => "discovery",
                "avvistamento" => "sighting",
                "comunicazione" => "comunication",
                "new-entry" => "new-entry"
            ];

            $article = str_replace("<tag-type/>",$cssTags[$articleTag],$article);
            
            $article = str_replace("<article-title/>",$articleTitle,$article);

            $article = str_replace("<article-id/>",$articleId,$article);
            
            $relArticles .= $article;
        }
        $page = str_replace("<related-articles/>",$relArticles,$page);
    }
    echo $page;
?>