<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";


    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin') {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }

    $_SESSION["prev_page"] =  $admin_page_article_list_ref;

    $page = file_get_contents($html_path . "admin-article-list.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    $tag = clearInput($_GET["tag"] ?? "") ;
    $search = clearInput($_GET["search"] ?? "");

    $query = 'SELECT * FROM view_articolo_utente';

    if ($tag !== "" && $search !== "") {
        $query .= ' WHERE tag = "' . $tag . '" AND titolo LIKE "%' . $search . '%"';
    } elseif ($tag !== "") {
        $query .= ' WHERE tag = "' . $tag . '"';
    } elseif ($search !== "") {
        $query .= ' WHERE titolo LIKE "%' . $search . '%"';
    }

    $query .= ' ORDER BY data DESC;';
    $queryResult = mysqli_query($mysqli, $query);

    if (!$queryResult) {
        header("Location: " . $html_path . "404.html");
        exit();
    }

    $table = file_get_contents($modules_path . "admin-article-table.html");
    $article_entry = file_get_contents($modules_path . "admin-article-entry.html");

    $articleList = "";

    while ($articleResult = mysqli_fetch_assoc($queryResult)) {
        $article = $article_entry;
        $articleId = $articleResult["id"];
        $articleTitle = $articleResult["titolo"];
        $articleAuthor = $articleResult["nome"];
        $articleDate = $articleResult["data"];
        $articlePlace = $articleResult["luogo"];
        $articleTag = $articleResult["tag"];

        $article = str_replace("<article-id/>",$articleId,$article);
        $article = str_replace("<article-title/>",$articleTitle,$article);
        $article = str_replace("<article-author/>",$articleAuthor,$article);
        $article = str_replace("<article-date/>",$articleDate,$article);
        $article = str_replace("<article-place/>",$articlePlace,$article);
        $article = str_replace("<article-tag/>",$articleTag,$article);
        
        $articleList .= $article;
    }
    

    $table = str_replace("<article-entry/>",$articleList,$table);
    $page = str_replace("<article-table/>",$table,$page);
    $page = str_replace("<count/>",$queryResult->num_rows,$page);

    $queryResult->free_result();
    $mysqli->close();

    echo $page;
?>