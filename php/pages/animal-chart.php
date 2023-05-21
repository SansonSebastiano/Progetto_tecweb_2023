<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    require ".." . DIRECTORY_SEPARATOR . "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_chart_ref . "?order=" . $_GET["order"];

    $page = file_get_contents($html_path . "animal-chart.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    $animal_entry = file_get_contents($modules_path . "animal-chart-entry.html");

    $type_order = $_GET["order"];

    $query = "";

    if ($type_order == "uporder") {
        $query = 'SELECT * FROM view_animale_voto ORDER BY YES DESC;';
    } elseif ($type_order == "downorder") {
        $query = 'SELECT * FROM view_animale_voto ORDER BY NO DESC;';
    } else {
        $query = 'SELECT * FROM view_animale_voto ORDER BY nome ASC;';
    }

    $queryResult = mysqli_query($mysqli, $query);

    if (!$queryResult) {
        include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html";
        exit();
    }

    $entries = "";

    while ($result = mysqli_fetch_assoc($queryResult)) {

        $entry = $animal_entry;
        $entry = str_replace("<animal/>", $result["nome"], $entry);
        $entry = str_replace("<animal-name/>", $result["nome"],$entry);

        $yes = $result["YES"];
        $no = $result["NO"];

        if (is_null($yes)) {
            $yes = 0;
        }

        if (is_null($no)) {
            $no = 0;
        }

        $entry = str_replace("<yes-votes/>", $yes,$entry);
        $entry = str_replace("<no-votes/>", $no,$entry);
        $entry = str_replace("<animal-image/>", $result["image_path"],$entry);
        //$entry = str_replace("<animale-image-alt/>", $result["alt"],$entry);
        $entry = str_replace("<animal-status/>", $result["status"],$entry);

        $entries .= $entry;
    }
    $page = str_replace("<entries/>",$entries,$page);

    $queryResult->free();
    $mysqli->close();

    echo $page;
?>