<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";
    include "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $errorCodes = [
        "testo" => 0,
        "submit" => 0
    ];
    $errorFlag = False;

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["article"])) {

        $testo = clearInput($_POST['testo']);

        if(strlen($testo) < 20){
            $errorCodes["testo"] = 1;
            $errorFlag = True;
        }

        $testo = filter_var($testo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$errorFlag){
            $query = "UPDATE articolo SET contenuto = '$testo' WHERE id = '" . $_GET["article"] . "'";
            $queryResult = mysqli_query($mysqli, $query);
        

            if($queryResult) {

                $queryResult->free();
                $mysqli->close();
                
                header("Location: ./pages/article.php?article=" . $_GET["article"]);
                exit();
            }
            else {
                $errorCodes["submit"] = 1;
            }
        }

        $queryResult->free();
        $mysqli->close();

        $_SESSION["error-codes"] = $errorCodes;
        header("Location: " . $_SESSION["prev_page"]);
    }
?>