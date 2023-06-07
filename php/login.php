<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";

    include ".." . DIRECTORY_SEPARATOR . "config.php";
    // import the connection script
    include  'db-conn.php';
    // import input cleaner script
    include 'input-cleaner.php' ;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-login.html");

    $username = "";
    $password = "";
    $resultString = "";
    if (isset($_POST['submit']) && array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
        
        // set Location header
        $location = "Location: " . $_SESSION["prev_page"];
        // get the data from the form:
        // username
        $username = clearInput($_POST['username']);

        // password
        $password = clearInput($_POST['password']);
                
        // $passwordHashed = hash("sha256", $password);

        // echo "<script>console.log('Password hash: " .  $passwordHashed . "');</script>";
        // create a query
        $query = "SELECT * FROM `utente` WHERE `nome` = '$username' AND `password` = '$password'";
        // execute the query
        $result = $mysqli->query($query);
        // check if the query was executed successfully and if the result is not empty
        if ($result->num_rows == 0) {
                    
            $resultString = "<p class='error' tabindex='0'>Username o password non corretti!</p>";

            $mysqli->close();
        } else {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["username"] = $row["nome"];
                $_SESSION["id"] = $row["id"];

                switch($row["ruolo"]){
                    case ADMIN_ROLE:
                        $_SESSION["ruolo"] = ADMIN_ROLE;
                        break;
                    case WRITER_ROLE:
                        $_SESSION["ruolo"] = WRITER_ROLE;
                        break;
                    case USER_ROLE:
                        $_SESSION["ruolo"] = USER_ROLE;
                        break;
                }

                header($location);
            }

            // free the result set
            $result->free();
            // close the connection
            $mysqli->close();
        }
    }

    $page = str_replace("<result/>", $resultString, $page);

    echo $page;
?>