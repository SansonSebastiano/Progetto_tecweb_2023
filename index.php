<?php
    require "config.php";
    require $php_path . "check-conn.php";
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $index_ref;

    $page = file_get_contents($html_path . "index.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    $admin_section = "<button class=\"btn-primary\" onclick=\"location.href='" . $admin_page_ref . "'\" tabindex='2'>Sezione Amministratore</button>";

    $writer_section = "<button class=\"btn-primary\" onclick=\"location.href='" . $faar_ref . "'\" tabindex='2'>Scrivi un nuovo articolo</button>";

    if ($_SESSION["ruolo"] == "admin") {
        $page = str_replace("<admin-section/>", $admin_section, $page);
    } else {
        $page = str_replace("<admin-section/>", "", $page);
    }

    if ($_SESSION["ruolo"] == "writer") {
        $page = str_replace("<writer-section/>", $writer_section, $page);
    } else {
        $page = str_replace("<writer-section/>", "", $page);
    }

    $homeChart = file_get_contents($modules_path . "home-chart.html");

    $query = 'SELECT nome, image_path, alt FROM view_animale_voto ORDER BY YES DESC LIMIT 5;';
    $queryResult = mysqli_query($mysqli, $query);

    $entries = "";

    while ($result = mysqli_fetch_assoc($queryResult)) {

        $entry = $homeChart;
        $entry = str_replace("<chart-img/>", $result["image_path"], $entry);
        $entry = str_replace("<chart-img-alt/>", $result["alt"], $entry);
        $entry = str_replace("<animal-name/>", $result["nome"], $entry);

        $entries .= $entry;
    }

    $queryResult->free();

    $page = str_replace("<home-chart-entries/>", $entries, $page);

    echo $page;
?>
