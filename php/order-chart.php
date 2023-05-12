<?php
    $incoming = $_GET['sendValue'];

    if (isset($incoming)) {
        print_r("Received: " . $incoming . "\n");
    } else {
        print_r("No value received\n");
    }
    
?>