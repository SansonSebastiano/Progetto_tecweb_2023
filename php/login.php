<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";

    include ".." . DIRECTORY_SEPARATOR . "config.php";
    // import the connection script
    require  'db-conn.php';
    // import input cleaner script
    include 'input-cleaner.php' ;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
                
                // get the data from the form:
                // username
                $username = clearInput($_POST['username']);

                // password
                $password = clearInput($_POST['password']);

                // create a query
                $query = "SELECT * FROM `utente` WHERE `nome` = '$username' AND `password` = '$password'";
                // execute the query
                $result = $mysqli->query($query);
                // check if the query was executed successfully and if the result is not empty
                $mysqli->close();
                if ($result->num_rows == 0) {

                    header("Location: " . $form_login_ref);
                    exit();

                } else {

                        $row = $result->fetch_assoc();
                        if ($row["ruolo"] == ADMIN_ROLE) {

                            $_SESSION["ruolo"] = ADMIN_ROLE;

                        } elseif ($row["ruolo"] == WRITER_ROLE) {

                            $_SESSION["ruolo"] = WRITER_ROLE;

                        } else {

                            $_SESSION["ruolo"] = USER_ROLE;

                        }
                        $_SESSION["username"] = $row["nome"];
                        $_SESSION["id"] = $row["id"];

                        header("Location: " . $_SESSION["prev_page"]);
                        exit();

                    $result->free();
                }
            }
        }
    }
?>