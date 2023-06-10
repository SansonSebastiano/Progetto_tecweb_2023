<?php

if(isset($page)){
    $header = file_get_contents($modules_path . "header.html");
    $footer = file_get_contents($modules_path . "footer.html");
    $goUp = file_get_contents($modules_path . "go-up.html");

    if(isset($goUpPath)){
        $goUp = str_replace("<path/>", $goUpPath, $goUp);
        $goUp = str_replace("<path/>", $goUpPath, $header);
    }else{
        $goUp = str_replace("<path/>", "./", $goUp);
        $goUp = str_replace("<path/>", "./", $header);
    }

    $page = str_replace("<header/>", $header, $page);
    $page = str_replace("<footer/>", $footer, $page);
    $page = str_replace("<go-up/>", $goUp, $page);
}
?>