<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-edit-article.html");

    if ($_SESSION['ruolo'] != 'admin') {
        header("Location: " . $index_ref);
        exit();
    }

    $_SESSION["prev_page"] =  $form_edit_article_ref . "?article=" . $_GET["article"];

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    $errTesto =  [0 => "", 1 => "Il testo dell'articolo deve essere lungo almeno 20 caratteri"];
    $errSubmit = [0 => "", 1 => "<p class='error'><strong>Errore nell'aggiornamento dell'articolo</strong></p>"];

    if (isset($_GET["article"])) {
        $articleId = clearInput($_GET["article"]);
        $query = "SELECT * FROM articolo WHERE id = " . $articleId;
        $queryResult = mysqli_query($mysqli, $query);

        $result = mysqli_fetch_assoc($queryResult);

        if (!$result) {
            $mysqli->close();
            header("Location: " . $html_ref . "404.html");
            exit();
        }
        
        $articleTitle = $result["titolo"];
        $articleContent = $result["contenuto"];

        $page = str_replace("<article-id/>",$articleId,$page);
        $page = str_replace("<article-title/>",$articleTitle,$page);
        $page = str_replace("<article-content/>",$articleContent,$page);

        if(isset($_SESSION["error-codes"]))
        {
            $ec = $_SESSION["error-codes"];
            $page = str_replace("<result/>",$errSubmit["error-result"], $page);
            $page = str_replace("<error-text/>",$errorStrings["testo"], $page);
            unset($_SESSION["error-codes"]);
        }
        else
        {
            $page = str_replace("<result/>","", $page);
            $page = str_replace("<error-text/>","", $page);
        }

        $queryResult->free_result();

    } else {
        $mysqli->close();
        header("Location: " . $html_ref . "404.html");
        exit();
    }

    $mysqli->close();
    echo $page;
?>