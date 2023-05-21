<?php
    function clearInput(string $value) {
        $value = trim($value);          //trim() rimuove gli spazi bianchi (o altri caratteri) dall'inizio e dalla fine di una stringa
        $value = strip_tags($value);    //strip_tags() rimuove le tag HTML e PHP da una stringa
        //$value = htmlentities($value);  //htmlentities() converte i caratteri speciali in entità HTML

        return $value;
    }
?>