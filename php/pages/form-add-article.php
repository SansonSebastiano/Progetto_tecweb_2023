<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SESSION['ruolo'] != 'admin' && $_SESSION['ruolo'] != 'writer') {
        //echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
    }
    $_SESSION["prev_page"] =  $faar_ref;

    $result = "";

    $page = file_get_contents($html_path . "form-add-article.html");

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $titolo = clearInput(filter_input(INPUT_POST,"titolo",FILTER_SANITIZE_SPECIAL_CHARS));
        $sottotitolo = clearInput(filter_input(INPUT_POST,"Sottotitolo",FILTER_SANITIZE_SPECIAL_CHARS));
        $tag = clearInput($_POST['tag']);
        $luogo = clearInput(filter_input(INPUT_POST,"luogo",FILTER_SANITIZE_SPECIAL_CHARS));
        $data = clearInput($_POST['data_scrittura']);
        $testo = clearInput($_POST['testo']);
        $autore = clearInput($_SESSION['id']);
        $path = clearInput($_POST['image-path']);
        $creatura = clearInput(filter_input(INPUT_POST,"creatura",FILTER_SANITIZE_SPECIAL_CHARS));

        $sql = "INSERT INTO `articolo` (`autore`,`titolo`, `data`, `luogo`, `descrizione`,`contenuto`, `image_path`,`tag`,`featured`,`alt`) VALUES ('$autore', '$titolo', '$data', '$luogo', '$sottotitolo', '$testo', '$path', '$tag', 0, '$testo')";
        $queryResult = mysqli_query($mysqli, $sql);
        $id_query = "SELECT MAX(`id`) FROM `articolo`";
        $queryResult = mysqli_query($mysqli,$id_query);
        $data = mysqli_fetch_array($queryResult);
        $id = $data[0];

        if ($queryResult) {
            // free the result set
            $queryResult->free();
        }
        //TODO: inserire articolo_animale
    
        $sql = "INSERT INTO `articolo_animale` (`articolo`,`animale`) VALUES ('$id', '$creatura')";
        $queryResult = mysqli_query($mysqli,$sql);

        if ($queryResult) {
            header("Location: " . "." . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "form-add-article.php ");
            exit();
        }

        $result = "<p class='success'>Articolo inserito con successo!</p>";
    }

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"] ?? "ospite", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    $page = str_replace("<result/>", $result, $page);

    $who_am_i = "<a href=' admin-page-home.php' tabindex='3'> Amministrazione</a>|" ;

    if ($_SESSION["ruolo"] == "admin") {
        $page = str_replace("<who-am-i/>", $who_am_i, $page);
    } else {
        $page = str_replace("<who-am-i/>", "" , $page);
    }
    
    echo $page;
?>