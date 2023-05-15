<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["prev_page"] = $article_list_ref;

    $page = file_get_contents($html_path . "article-list.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $logUserConn, $page);
    
    // Vogliamo prelevare gli articoli dal database, estraendo il tag e la stringa di ricerca (ricerchiamo nel titolo) dalla richiesta get se ci sono
    // Se non ci sono, allora preleviamo tutti gli articoli

    $tag = $_GET["tag"] ?? "";
    $search = $_GET["search"] ?? "";

    $query = 'SELECT * FROM articolo';

    if ($tag !== "" && $search !== "") {
        $query .= ' WHERE tag = "' . $tag . '" AND titolo LIKE "%' . $search . '%"';
    } else if ($tag !== "") {
        $query .= ' WHERE tag = "' . $tag . '"';
    } else if ($search !== "") {
        $query .= ' WHERE titolo LIKE "%' . $search . '%"';
    }

    // Ora di ordinare gli articoli per data
    $query .= ' ORDER BY data DESC;';

    // e di eseguire la query
    $queryResult = mysqli_query($mysqli, $query);

    if (!$queryResult) {
        include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html";
        exit();
    }

    $articleTemplate = file_get_contents($modules_path . "article-template.html");

    // Per ogni articolo, creiamo un template e lo aggiungiamo alla pagina usando il placeholder <article-list/>

    $articleList = "";

    while($articleResult = mysqli_fetch_assoc($queryResult)){
        $article = $articleTemplate;
        $articleTitle = $articleResult["titolo"];
        $articleId = $articleResult["id"];
        $articleTag = $articleResult["tag"];
        $articleImage = $articleResult["image_path"];
        $articleImageAlt = $articleResult["alt"];
        
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

        $article = str_replace("<image-article/>",$articleImage,$article);

        $article = str_replace("<image-alt/>",$articleImageAlt,$article);
        
        $articleList .= $article;
    }

    // Rimuoviamo il placeholder <article-list/> e sostituiamo con la lista di articoli
    $page = str_replace("<article-list/>",$articleList,$page);
    
    echo $page;
?>