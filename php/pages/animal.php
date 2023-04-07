<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "check_conn.php");

    $page = file_get_contents(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "animal.html");

    $page = str_replace("<user />", "Ciao, " . $_SESSION["username"], $page);
    $page = str_replace("<userImg />", "<img src=\"../../images/icons/icon-user.png\" class = \"profile-pic\" alt = \"utente\"/>", $page);
    $page = str_replace("<log_in_out />", $log_in_out, $page);

    if($_GET["animale"]){
        $query = 'SELECT * FROM animale WHERE nome = "'. $_GET["animale"] . '";';
        $queryResult = mysqli_query($connessione, $query);
        if(!$queryResult){
            include_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html");
            exit();
        }

        $result = mysqli_fetch_assoc($queryResult);

        if(!$result){
            include_once(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html");
            exit();
        }

        $queryResult->free();

        $animalName = $result["nome"];
        $description = $result["descrizione"];
        $image = $result["image_path"];
        $scoperta = $result["data_scoperta"];
        $status = $result["status"];

        $page = str_replace("<animalName/>",$animalName,$page);

        $page = str_replace("<animalDescription/>",$description,$page);

        $page = str_replace("<dataScoperta/>",$scoperta,$page);

        $page = str_replace("<animalStatus/>",ucfirst($status),$page);

        $queryTwo = 'SELECT * FROM articolo JOIN articolo_animale ON articolo.id = articolo_animale.articolo WHERE animale = "'. $_GET["animale"] . '" ORDER BY articolo.data;';
        $queryResultTwo = mysqli_query($connessione, $queryTwo);

        $articleResult = mysqli_fetch_assoc($queryResultTwo);

        $articleTitle = $articleResult["titolo"];
        $articleDescription = $articleResult["descrizione"];
        $articleTag = $articleResult["tag"];
        $ultimoAvv = $articleResult["data"];

        $page = str_replace("<recentTitle/>",$articleTitle,$page);

        $page = str_replace("<recentDescription/>",$articleDescription,$page);

        $page = str_replace("<recentTag/>",strtoupper($articleTag),$page);

        $page = str_replace("<ulitmoAvvistamento/>",explode(" ",$ultimoAvv,2)[0],$page);

        $relArticleTemplate = file_get_contents(".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "related_article_template.html");

        mysqli_data_seek($queryResultTwo,0);
        $relArticles = "";
        while($articleResult = mysqli_fetch_assoc($queryResultTwo)){
            $article = $relArticleTemplate;
            $articleTitle = $articleResult["titolo"];
            $articleId = $articleResult["id"];
            $articleTag = $articleResult["tag"];
            
            $article = str_replace("<recentTag/>",$articleTag,$article);

            $article = str_replace("<articleTitle/>",$articleTitle,$article);

            $article = str_replace("<articleId/>",$articleId,$article);
            
            $relArticles .= $article;
        }
        $page = str_replace("<relatedArticles/>",$relArticles,$page);
    }
    echo $page;
?>