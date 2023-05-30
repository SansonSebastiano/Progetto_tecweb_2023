<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-edit-article.html");

    if ($_SESSION['ruolo'] != 'admin' /*&& $_SESSION['ruolo'] != 'writer'*/) {
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
        exit();
    }

    $_SESSION["prev_page"] =  $form_edit_article_ref . "?article=" . $_GET["article"];

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    if (isset($_GET["article"])) {
        $articleId = clearInput($_GET["article"]);
        $query = "SELECT * FROM articolo WHERE id = " . $articleId;
        $queryResult = mysqli_query($mysqli, $query);

        if (!$queryResult) {
            header("Location: " . $html_path . "404.html");
            exit();
        }

        $result = mysqli_fetch_assoc($queryResult);
        
        $queryResult->free();

        //Mi ricavo le informazioni principali dell'articolo

        $articleTitle = $result["titolo"];
        $articleContent = $result["contenuto"];

        //Sostituisco i placeholder con i valori dell'articolo
        $page = str_replace("<article-id/>",$articleId,$page);
        $page = str_replace("<article-title/>",$articleTitle,$page);
        $page = str_replace("<article-content/>",$articleContent,$page);
    } else {
        header("Location: " . $html_path . "404.html");
        exit();
    }

    $mysqli->close();
    echo $page;
?>