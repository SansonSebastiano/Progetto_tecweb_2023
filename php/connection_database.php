<?php
    $host = "localhost";
    $user = "elusive";
    $password= "";
    $db = "my_elusive";
    $connessione = new mysqli($host,$user,$password,$db);
    if($mysqli->connect_errno ) {
        printf("Connect failed: %s<br />", $mysqli->connect_error);
        exit();
    } else {
        printf("Connected successfully.<br />");
    }

    // Perform query 
/*
    if ($result = $mysqli -> query("SELECT * FROM articolo")) {
        echo "Returned rows are: " . $result -> num_rows;
        // Free result set
        $result -> free_result();
    }

    $mysqli->close();
    */
?>
