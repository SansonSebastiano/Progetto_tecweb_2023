<?php
$host = "localhost";
$user = "elusive";
$password= "root";
$db = "my_elusive";
$connessione = new mysqli($host,$user,$password,$db);
if (mysqli_connect_errno()) {
    echo "Connessione fallita (". mysqli_connect_errno()
    . "): " . mysqli_connect_error();
    exit();
    } else
    {
        echo "Connessione riuscita";
    }

?>
