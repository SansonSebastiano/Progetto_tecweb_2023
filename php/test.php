<?php
    // import the connection script
    require_once 'connection_database.php';

    // create a select query for sample_db
    $query = "SELECT * FROM animale";
    // execute the query

    $result = $mysqli->query($query);
    // check if the query was executed successfully
    if (!$result) {
        echo "Error: " . $mysqli->error;
        exit();
    }
    
    echo '<br>';
    echo '<br>';
    echo 'Success: A proper query to MySQL eLusive was made.';
    echo '<br>';
    echo 'Number of rows: '.$result->num_rows;
    echo '<br>';
    echo '<br>';

    // iterate over the result set
    // fetch each row as an associative array
    while ($row = $result->fetch_assoc()) {
        echo "nome: " . $row["nome"] . "<br>";
        echo "descrizione: " . $row["descrizione"] . "<br>";
        echo "status: " . $row["status"] . "<br>";
        echo "data scoperta: " . $row["data_scoperta"] . "<br>";
        echo "url immagine: " . $row["image_path"] . "<br>";
        echo "alt: " . $row["alt"] . "<br>";
        echo "-----------------<br>";
    }

    // free the result set
    $result->free();
    // close the connection
    $mysqli->close();
?>