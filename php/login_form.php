<?php
    // import the connection script
    require_once 'connection_database.php';
    // import input cleaner
    include 'input_cleaner.php';

    if (isset($_POST['submit'])) {
        // get the data from the form
        $username = clearInput($_POST['username']);
        if (empty($username)) {
            echo "<li>Username is required<li>";
        }  

        $password = clearInput($_POST['password']);
        if (empty($password)) {
            echo "<li>Password is required<li>";
        }  

        // create a query 
        $query = "SELECT * FROM `utente` WHERE `nome` = '$username' AND `password` = '$password'";
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
            echo "USERNAME: " . $row["nome"] . "<br>";
            echo "PASSWORD: " . $row["password"] . "<br>";
            echo "EMAIL: " . $row["email"] . "<br>";
            echo "RUOLO: " . $row["ruolo"] . "<br>";
            echo "-----------------<br>";
        }

        // free the result set
        $result->free();
        // close the connection
        $mysqli->close();
    } 
?>