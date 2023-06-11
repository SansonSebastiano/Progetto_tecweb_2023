<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";


    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["prev_page"] = $article_list_ref;

    $page = file_get_contents($html_path . "article-list.html");

    $goUpPath = "../../";
    include $php_path . "template-loader.php";

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

    
    $query .= ' ORDER BY data DESC;';

    
    $queryResult = mysqli_query($mysqli, $query);

    if (!$queryResult) {
        $mysqli->close();

        header("Location: " . $php_path . "404.php");
        exit();
    }

    $articleTemplate = file_get_contents($modules_path . "article-template.html");

    
    if($queryResult->num_rows == 0){
        $articleList = "<li>Nessun articolo trovato</li>";
    }else{

        $articleList = "";

    while($articleResult = mysqli_fetch_assoc($queryResult)){
        $article = $articleTemplate;
        $articleTitle = $articleResult["titolo"];
        $articleId = $articleResult["id"];
        $articleTag = $articleResult["tag"];
        $articleImage = $articleResult["image_path"];
        $articleImageAlt = $articleResult["alt"];
        
            $article = str_replace("<article-tag/>",$articleTag,$article);
            
            $article = str_replace("<article-title/>",$articleTitle,$article);

            $article = str_replace("<article-id/>",$articleId,$article);

            $article = str_replace("<image-article/>",$articleImage,$article);

            $article = str_replace("<image-alt/>",$articleImageAlt,$article);
        
            $articleList .= $article;
        }
    }

    $page = str_replace("<count/>",$queryResult->num_rows,$page);
    
    $page = str_replace("<article-list/>",$articleList,$page);

    $queryResult->free_result();
    $mysqli->close();
    echo $page;
?>