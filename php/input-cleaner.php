<?php
    function clearInput($value) {
        $value = trim($value);          //trim() rimuove gli spazi bianchi (o altri caratteri) dall'inizio e dalla fine di una stringa
        $value = strip_tags($value);    //strip_tags() rimuove le tag HTML e PHP da una stringa
        //$value = htmlentities($value);  //htmlentities() converte i caratteri speciali in entità HTML
        
        echo "<script>console.log('CLEANED VALUE: " . $value . "');</script>";

        return $value;
    }
?>