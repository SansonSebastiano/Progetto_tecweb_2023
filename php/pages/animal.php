<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_ref . "?animale=" . $_GET["animale"];

    $page = file_get_contents($html_path . "animal.html");

    
   if (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != "guest") {
        $page = str_replace("<greet/>", "Ciao, ", $page);
        $page = str_replace("<user-img/>", $icon_user_ref, $page);
    } else {
        $page = str_replace("<greet/>", "", $page);
        $page = str_replace("<user-img/>", "", $page);
    }
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    
    if($_GET["animale"]){
        $animal = clearInput($_GET["animale"]);
        $query = 'SELECT * FROM animale WHERE nome = "'. $animal . '";';
        $queryResult = mysqli_query($mysqli, $query);

        $result = mysqli_fetch_assoc($queryResult);

        if(!$result){
            $mysqli->close();
            header("Location: " . $html_ref . "404.html");
            exit();
        }

        $animalName = $result["nome"];
        $description = $result["descrizione"];
        $image = $result["image_path"];
        $scoperta = $result["data_scoperta"];
        $status = $result["status"];
        $animaleImageAlt = $result["alt"];

        $page = str_replace("<animal-name/>",$animalName,$page);
        $page = str_replace("<animal-description/>",$description,$page);
        $page = str_replace("<data-scoperta/>",$scoperta,$page);
        $page = str_replace("<animal-status/>",ucfirst($status),$page);
        $page = str_replace("<animal-image/>",$image,$page);
        $page = str_replace("<animal-image-alt/>",$animaleImageAlt,$page);

        
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

        $queryResult->free_result();

        $voting_section = file_get_contents($modules_path . "animal-voting-section.html");
        
        
        if(isset($_SESSION["id"])){
            $queryTwo = 'SELECT * FROM voto WHERE animale = "'. $_GET["animale"] . '" AND utente = "' . $_SESSION["id"] . '";';
            $queryResultTwo = mysqli_query($mysqli, $queryTwo);
            if ($queryResultTwo->num_rows > 0) {
                $resultTwo = mysqli_fetch_assoc($queryResultTwo);
                $vote = $resultTwo['voto'];
                $msgNo = "<p id='msg-vote'>Hai votato <span class='red'>no</span> per questa creatura</p>";
                $msgYes = "<p id='msg-vote'>Hai votato <span class='green'>sì</span> per questa creatura</p>";
                $voting_section = str_replace("<is-btn-add-disabled/>", 'disabled', $voting_section);
                $voting_section = str_replace("<animal-vote-msg/>", $vote === 'NO' ? $msgNo : $msgYes, $voting_section);
                $voting_section = str_replace("<vote-type/>", $vote === 'NO' ? 'no' : 'yes', $voting_section);
                $voting_section = str_replace("<is-btn-remove-disabled/>", '', $voting_section);
            } else {
                $voting_section = str_replace("<is-btn-add-disabled/>", '', $voting_section);
                $voting_section = str_replace("<vote-msg/>", '', $voting_section);
                $voting_section = str_replace("<is-btn-remove-disabled/>", 'disabled', $voting_section);
            }
            $queryResultTwo->free_result();
        } 
        
        $voting_section = str_replace("<animal-name/>", $_GET["animale"], $voting_section);

        
        if ($_SESSION['ruolo'] != 'guest') {
            $page = str_replace("<animal-voting-section/>", $voting_section, $page);
        }

        
        $queryThree = 'SELECT * FROM articolo WHERE nome_animale = "'. $_GET["animale"] . '" ORDER BY data LIMIT 3;';
        $queryResultThree = mysqli_query($mysqli, $queryThree);

        $articleResult = mysqli_fetch_assoc($queryResultThree);

        $relArticleTemplate = file_get_contents($modules_path . "article-template.html");
        mysqli_data_seek($queryResultThree,0);
        $relArticles = "";
        while($articleResult = mysqli_fetch_assoc($queryResultThree)){
            $article = $relArticleTemplate;
            $articleTitle = $articleResult["titolo"];
            $articleId = $articleResult["id"];
            $articleTag = $articleResult["tag"];
            $articleImg = $articleResult["image_path"];
            $articleImgAlt = $articleResult["alt"];
            
            $article = str_replace("<article-title/>",$articleTitle,$article);
            $article = str_replace("<article-id/>",$articleId,$article);
            $article = str_replace("<article-tag/>",$articleTag,$article);
            $article = str_replace("<image-article/>",$articleImg,$article);
            $article = str_replace("<image-alt/>",$articleImgAlt,$article);
            
            $relArticles .= $article;
        }
        $page = str_replace("<related-articles/>",$relArticles,$page);
        
        $queryResultThree->free_result();

        $queryFour = 'SELECT * FROM articolo WHERE nome_animale = "'. $_GET["animale"] . '" AND tag = 3 ORDER BY data DESC;';
        $queryResultFour = mysqli_query($mysqli, $queryFour);
        $articleResult = mysqli_fetch_assoc($queryResultFour);
        if ($queryResultFour->num_rows > 0) {
            $ultimoAvv = $articleResult["data"];
            $page = str_replace("<ultimo-avvistamento/>",explode(" ",$ultimoAvv,2)[0],$page);
        }
        else {
            $page = str_replace("<ultimo-avvistamento/>", "", $page);
        }

        $queryResultFour->free_result();
    }

    $mysqli->close();
    echo $page;
?>