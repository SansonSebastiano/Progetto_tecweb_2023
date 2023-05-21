<?php
    // root path
    $root_server_side = __DIR__ . DIRECTORY_SEPARATOR;
    // php files
    $php_path = $root_server_side . "php" . DIRECTORY_SEPARATOR;
    // html files
    $html_path = $root_server_side . "html" . DIRECTORY_SEPARATOR;
    // modules files
    $modules_path = $html_path . "modules" . DIRECTORY_SEPARATOR;

    // user icon
    $icon_user_ref = "<img src=\"" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "icon-user.png" . "\" class = \"profile-pic\" alt = \"icona utente\"/>";
    // logout icon
    $icon_logout_ref = "<img src=\"" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "logout.png" . "\" id = \"logout\" alt = \"icona logout\"/>";

    // previous page (for 'prev_page' session variable):
    // index.php
    $root_client_side = DIRECTORY_SEPARATOR . "fceccato" . DIRECTORY_SEPARATOR;
    $index_ref = $root_client_side . "index.php";
    
    $php_pages_ref = $root_client_side . "php" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR;

    $html_ref = $root_client_side . "html" . DIRECTORY_SEPARATOR;
    // form-add-animal.php
    $faan_ref = $php_pages_ref . "form-add-animal.php";
    // form-add-article.php
    $faar_ref = $php_pages_ref . "form-add-article.php";
    // article.php
    $article_ref = $php_pages_ref . "article.php";
    // article-list.php
    $article_list_ref = $php_pages_ref . "article-list.php";
    // animal.php
    $animal_ref = $php_pages_ref . "animal.php";
    // animal-list.php
    $animal_list_ref = $php_pages_ref . "animal-list.php";
    // animal-chart.php
    $animal_chart_ref = $php_pages_ref . "animal-chart.php";
    // admin-home.php
    $admin_page_ref = $php_pages_ref . "admin-home.php";
    // admin-animal-list.php
    $admin_page_animal_list_ref = $php_pages_ref . "admin-animal-list.php";
    // admin-article-list.php
    $admin_page_article_list_ref = $php_pages_ref . "admin-article-list.php";
    // login-form.html
    $form_login_ref = $html_ref . "form-login.html";

    // icon user refrence
    $icon_user_ref = "<img src=\"" . $root_client_side . "images\\icons\\icon-user.png\" class=\"profile-pic\"alt=\"Utente\"/>";
?>