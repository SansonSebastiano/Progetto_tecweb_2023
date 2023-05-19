<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    require ".." . DIRECTORY_SEPARATOR . "db-conn.php";


    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_ref . "?animale=" . $_GET["animale"];

    $page = file_get_contents($html_path . "animal.html");

    // IDENTIFICATION
    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    // ANIMAL SECTION
    if($_GET["animale"]){
        $query = 'SELECT * FROM animale WHERE nome = "'. $_GET["animale"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        if(!$queryResult){
            include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html";
            exit();
        }

        $result = mysqli_fetch_assoc($queryResult);

        if(!$result){
            include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html";
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
        $page = str_replace("<animal-image/>",$image,$page);
        //$page = str_replace("<animal-image-alt/>",$image_alt,$page);

        // VOTES SECTION
        $query = 'SELECT YES, NO FROM view_animale_voto WHERE nome = "'. $_GET["animale"] . '";';
        $queryResult = mysqli_query($mysqli, $query);
        $result = mysqli_fetch_assoc($queryResult);

        $yes = $result['YES'];
        $no = $result['NO'];

        if (is_null($yes)) {
            $yes = 0;
        }

        if (is_null($no)) {
            $no = 0;
        }

        $page = str_replace("<yes-vote/>",$yes,$page);
        $page = str_replace("<no-vote/>",$no,$page);

        $queryResult->free();

        $voting_section = file_get_contents($modules_path . "animal-voting-section.html");
        // un utente può esprimere un solo voto per ciascun animale
        $queryThree = 'SELECT * FROM voto WHERE animale = "'. $_GET["animale"] . '" AND utente = "' . $_SESSION["id"] . '";';
        $queryResultThree = mysqli_query($mysqli, $queryThree);

        if ($queryResultThree->num_rows > 0) {
            $voting_section = str_replace("<is-clicked/>", 'true', $voting_section);
        } else {
            $voting_section = str_replace("<is-clicked/>", 'false', $voting_section);
        }

        // disabilita la sezione voto se l'utente non e' loggato
        if ($_SESSION['ruolo'] != 'guest') {
            $voting_section = str_replace("<animal-name/>", $_GET["animale"], $voting_section);
            $page = str_replace("<animal-voting-section/>", $voting_section, $page);
        }

        // RELATED ARTICLES SECTION
        $queryTwo = 'SELECT * FROM articolo JOIN articolo_animale ON articolo.id = articolo_animale.articolo WHERE animale = "'. $_GET["animale"] . '" ORDER BY articolo.data;';
        $queryResultTwo = mysqli_query($mysqli, $queryTwo);

        if(!$queryResultTwo){
            include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html";
            exit();
        }

        $articleResult = mysqli_fetch_assoc($queryResultTwo);

        $articleTitle = $articleResult["titolo"];
        $articleDescription = $articleResult["descrizione"];
        $articleTag = $articleResult["tag"];
        $ultimoAvv = $articleResult["data"];
        $articleImg = $articleResult["image_path"];
        //$articleImgAlt = $articleResult["alt"];

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
            $article = str_replace("<image-article/>",$articleImg,$article);
            //$article = str_replace("<image-alt/>",$articleImgAlt,$article);
            
            $relArticles .= $article;
        }
        $page = str_replace("<related-articles/>",$relArticles,$page);
        
        $queryResultTwo->free();
    }

    $mysqli->close();
    echo $page;
?>