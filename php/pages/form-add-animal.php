<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "input-cleaner.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $result = "";

    $page = file_get_contents($html_path . "form-add-animal.html");

    if ($_SESSION['ruolo'] != 'admin') {
        //echo "<script>alert('Spiacente! Non hai permessi di amministratore');</script>";
        header("Location: " . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "index.php ");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $nome = clearInput(filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS));
        $status = clearInput($_POST['status']);
        $descrizione = clearInput(filter_input(INPUT_POST,"description",FILTER_SANITIZE_SPECIAL_CHARS));
        $data = clearInput($_POST['data_scoperta']);
        $path = clearInput($_POST['image-path']);

        $sql = "SELECT * FROM animale WHERE nome = '$nome'";

        $query = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($query) > 0) {
            // free the result set
            $query->free();
            $result = "<p class='error'>Animale già presente!</p>";
        }
        else{
        
        $query->free();
        $sql = "INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES ('$nome', '$descrizione', '$status', '$data', '$path', '$nome')";

        $query = mysqli_query($mysqli, $sql);

        if ($query) {
            // free the result set
            //$query->free();
            $result = "<p class='success'>Animale inserito con successo!</p>";

            }
        }
    }

    $_SESSION["prev_page"] =  $faan_ref;


    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"] ?? "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);
    $page = str_replace("<result/>", $result, $page);
    
    echo $page;
?>