<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    const ADMIN_ROLE = "admin";
    const USER_ROLE = "user";
    const WRITER_ROLE = "writer";

    include ".." . DIRECTORY_SEPARATOR . "config.php";
    
    include  'db-conn.php';
    
    include 'input-cleaner.php' ;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $page = file_get_contents($html_path . "form-login.html");

    $goUpPath = "../";
    include $php_path . "template-loader.php";
    $username = "";
    $password = "";
    $resultString = "";
    if (isset($_POST['submit']) && array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
        
        
        $location = "Location: " . $_SESSION["prev_page"];
        
        
        $username = clearInput($_POST['username']);

        
        $password = clearInput($_POST['password']);
                
        
        $query = "SELECT * FROM `utente` WHERE `nome` = '$username' AND `password` = '$password'";
        
        $result = $mysqli->query($query);
        
        if ($result->num_rows == 0) {
                    
            $resultString = "<p class='error' tabindex='0'><strong>Username o password non corretti!</strong></p>";

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
            }

            
            $result->free_result();
            
            $mysqli->close();

            header($location);
            exit();
        }
    }

    $page = str_replace("<result/>", $resultString, $page);

    echo $page;
?>