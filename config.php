<?php
    // root path
    $root = __DIR__ . DIRECTORY_SEPARATOR;
    // index.php
    $index_path = $root . "index.php";
    // php files
    $php_path = $root . "php" . DIRECTORY_SEPARATOR;
    // conn files
    $conn_path = $php_path . "conn" .DIRECTORY_SEPARATOR;
    // php pages
    $pages_path = $php_path . "pages" . DIRECTORY_SEPARATOR;
    // html files
    $html_path = $root . "html" . DIRECTORY_SEPARATOR;
    // modules files
    $modules_path = $html_path . "modules" . DIRECTORY_SEPARATOR;
    // images
    $img_path = $root . "images" . DIRECTORY_SEPARATOR;
    // articles images
    $articles_img_path = $img_path . "articles" . DIRECTORY_SEPARATOR;
    // icons images
    $icons_img_path = $img_path . "icons" . DIRECTORY_SEPARATOR;

    // icon user refrence
    $icon_user_ref = "<img src=\"" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "icons" . DIRECTORY_SEPARATOR . "icon-user.png" . "\" class = \"profile-pic\" alt = \"icona utente\"/>";

    // previous page (for 'prev_page' session variable)):
    // index.php
    $index_ref = DIRECTORY_SEPARATOR . "index.php";
    $php_pages_ref = DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR;
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
    $login_form_ref = DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "form-login.html";
?>