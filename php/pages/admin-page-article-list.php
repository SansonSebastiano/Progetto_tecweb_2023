<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin') {
        //echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
    }

    $_SESSION["prev_page"] =  $admin_page_article_list_ref;

    $page = file_get_contents($html_path . "admin-page-article-list.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    $tag = $_GET["tag"] ?? "";
    $search = $_GET["search"] ?? "";

    $query = 'SELECT * FROM view_articolo_utente';

    if ($tag !== "" && $search !== "") {
        $query .= ' WHERE tag = "' . $tag . '" AND titolo LIKE "%' . $search . '%"';
    } else if ($tag !== "") {
        $query .= ' WHERE tag = "' . $tag . '"';
    } else if ($search !== "") {
        $query .= ' WHERE titolo LIKE "%' . $search . '%"';
    }

    $query .= ' ORDER BY data DESC;';
    $queryResult = mysqli_query($mysqli, $query);

    $table = file_get_contents($modules_path . "admin-article-table.html");
    $article_entry = file_get_contents($modules_path . "admin-article-entry.html");
    $page = file_get_contents($html_path . "admin-page-article-list.html");

    $articleList = "";

    while($articleResult = mysqli_fetch_assoc($queryResult)){
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

    $page = str_replace("<article-list/>",$table,$page);

    echo $page;
?>  