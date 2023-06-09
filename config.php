<?php
    $root_server_side = __DIR__ . DIRECTORY_SEPARATOR;
    $php_path = $root_server_side . "php" . DIRECTORY_SEPARATOR;
    $html_path = $root_server_side . "html" . DIRECTORY_SEPARATOR;
    $modules_path = $html_path . "modules" . DIRECTORY_SEPARATOR;

    $root_client_side = DIRECTORY_SEPARATOR . "fceccato" . DIRECTORY_SEPARATOR;
    $index_ref = $root_client_side . "index.php";
    $php_pages_ref = $root_client_side . "php" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR;
    $html_ref = $root_client_side . "html" . DIRECTORY_SEPARATOR;
    $faan_ref = $php_pages_ref . "form-add-animal.php";
    $faar_ref = $php_pages_ref . "form-add-article.php";
    $article_ref = $php_pages_ref . "article.php";
    $article_list_ref = $php_pages_ref . "article-list.php";
    $animal_ref = $php_pages_ref . "animal.php";
    $animal_list_ref = $php_pages_ref . "animal-list.php";
    $animal_chart_ref = $php_pages_ref . "animal-chart.php";
    $admin_page_ref = $php_pages_ref . "admin-home.php";
    $admin_page_animal_list_ref = $php_pages_ref . "admin-animal-list.php";
    $admin_page_article_list_ref = $php_pages_ref . "admin-article-list.php";
    $form_login_ref = $html_ref . "form-login.html";
    $form_edit_article_ref = $php_pages_ref . "form-edit-article.php";

    $icon_user_ref = "<img src=\"" . $root_client_side . "images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "icon-user.png" . "\" class = \"profile-pic\" alt = \"icona utente\"/>";
    $icon_logout_ref = "<img src=\"" . $root_client_side . "images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "logout.png" . "\" id = \"logout\" alt = \"icona logout\"/>";

?>