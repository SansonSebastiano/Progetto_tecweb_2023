<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_chart_ref;

    $page = file_get_contents($html_path . "animal-chart.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    $animal_entry = file_get_contents($modules_path . "animal-chart-entry.html");
    
    $query = 'SELECT * FROM view_animale_voto;';
    $queryResult = mysqli_query($mysqli, $query);

    if (!$queryResult) {
        include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "404.html";
        exit();
    }

    $entries = "";

    while ($result = mysqli_fetch_assoc($queryResult)) {

        $entry = $animal_entry;
        $entry = str_replace("<animal/>", $result["nome"], $entry);
        $entry = str_replace("<animal-name/>",$result["nome"],$entry);
        $entry = str_replace("<yes-votes/>",$result["YES"],$entry);
        $entry = str_replace("<no-votes/>",$result["NO"],$entry);
        $entry = str_replace("<animal-image/>",$result["image_path"],$entry);
        $entry = str_replace("<animale-image-alt/>",$result["alt"],$entry);
        $entry = str_replace("<animal-status/>",$result["status"],$entry);

        $entries .= $entry;
    }

    $queryResult->free();

    $page = str_replace("<entries/>",$entries,$page);


    echo $page;
?>