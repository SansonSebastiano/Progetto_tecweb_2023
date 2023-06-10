<?php
    include ".." . DIRECTORY_SEPARATOR . "config.php";
    include "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $voteType = $_GET["voteType"];
    $animal = $_GET["animale"];

    $writeQuery = 'DELETE FROM `voto` WHERE utente="' . $_SESSION["id"] . '" AND animale= "' . $animal . '";';

    if (isset($voteType) && !empty($voteType) && isset($animal) && !empty($animal)) {
        if ($voteType === "yes") {
            
            $readQuery = 'SELECT nome, YES FROM view_animale_voto WHERE nome = "'. $animal . '";';
            $readQueryResult = mysqli_query($mysqli, $readQuery);
            $result = mysqli_fetch_assoc($readQueryResult);
            $yes = $result['YES'];

            
            $writeQueryResult = mysqli_query($mysqli, $writeQuery);

            
            if ($writeQueryResult) {
                $yes = $yes - 1;
                if ($yes <= 0) {
                    print_r(0);
                } else {
                    print_r($yes);
                }
            }
        } else {
            
            $readQuery = 'SELECT nome, NO FROM view_animale_voto WHERE nome = "'. $animal . '";';
            $readQueryResult = mysqli_query($mysqli, $readQuery);
            $result = mysqli_fetch_assoc($readQueryResult);
            $no = $result['NO'];

            
            $writeQueryResult = mysqli_query($mysqli, $writeQuery);

            
            if ($writeQueryResult) {
                $no = $no - 1;
                if ($no <= 0) {
                    print_r(0);
                } else {
                    print_r($no);
                }
            }
        }
    }

    $mysqli->close();
?>