<?php
    // DA ELIMINARE UNA TERMINATI I TEST

    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit']) && isset($_SESSION["ruolo"])) {
            // check user privilege
            echo "<script>console.log('SESSION SETTED');</script>";
            echo "<script>console.log('SESSION ROLE: " . $_SESSION["ruolo"] . "');</script>";

            if ($_SESSION["ruolo"] == ADMIN_ROLE) {
                echo "<script>console.log('ADMIN SECTION');</script>";
                require_once("." . DIRECTORY_SEPARATOR . "admin_conn.php");
                
            } elseif ($_SESSION["ruolo"] == WRITER_ROLE) {
                echo "<script>console.log('WRITER SECTION');</script>";
                require_once("." . DIRECTORY_SEPARATOR . "writer_conn.php");

                echo "<script>console.log('ID AUTORE: " . $_SESSION["id"] . "');</script>";

                $author = $_SESSION["id"];

                // create a query
                $query = "DELETE FROM `articolo` WHERE `articolo`.`autore` = $author AND `articolo`.`id` = 7";
                // execute the query
                $result = $mysqli->query($query);
                // check if the query was executed correctly
                if (!$result) {
                    echo "<script>console.log('QUERY FAILED');</script>";
                } else {
                    echo "<script>console.log('QUERY SUCCESS');</script>";
                }

            } elseif ($_SESSION["ruolo"] == USER_ROLE) {
                echo "<script>console.log('LOGGED SECTION');</script>";
                require_once("." . DIRECTORY_SEPARATOR . "logged_conn.php");
                // correct way to insert data
                //$query = "INSERT INTO `commento` (`id`, `articolo`, `utente`, `contenuto`, `data`) VALUES (NULL, 2, 2, '6', '2021-01-01 00:00:00')";
            } else {    // GUEST_ROLE
                echo "<script>console.log('GUEST SECTION');</script>";
                require_once("." . DIRECTORY_SEPARATOR . "guest_conn.php");
            }
            
        } else {
            echo "<script>console.log('SESSION NOT SETTED');</script>";
            echo "<script>console.log('SESSION ROLE: " . $_SESSION["ruolo"] . "');</script>";
        }
    }

    // ATTENZIONE ALLE SEGUENTI RIGHE
    // free the result set
    $result->free();
    // close the connection
    $mysqli->close();
?>