<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    include ".." . DIRECTORY_SEPARATOR . "check-conn.php";
    include ".." . DIRECTORY_SEPARATOR . "db-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_list_ref;

    $table = file_get_contents($modules_path . "letter-table.html");
    $animal_entry = file_get_contents($modules_path . "animal-entry.html");
    $page = file_get_contents($html_path . "animal-list.html");

    
   if (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != "guest") {
        $page = str_replace("<greet/>", "Ciao, ", $page);
        $page = str_replace("<user-img/>", $icon_user_ref, $page);
    } else {
        $page = str_replace("<greet/>", "", $page);
        $page = str_replace("<user-img/>", "", $page);
    }
    $page = str_replace("<user/>", isset($_SESSION["username"]) ? $_SESSION["username"] : "", $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);

    $alphas = range('A', 'Z');

    $query = "SELECT nome,descrizione,status FROM animale WHERE nome REGEXP '^[^a-zA-Z]' ORDER BY nome ASC;";
    $queryResult = mysqli_query($mysqli, $query);
    $row = "";

    $navigator = "";
    $all_sections = "";

    foreach($alphas as $letter){
        $sql = "SELECT nome,descrizione,status FROM animale WHERE LOWER(nome) REGEXP '^" . $letter . "' ORDER BY nome ASC;";
        $query = mysqli_query($mysqli, $sql);
        $animals = "";
        if($query->num_rows > 0){
            $newTable = str_replace("<letter/>",$letter,$table);
            $newTable = str_replace("<letter-title/>",$letter,$newTable);
            $navigator .= '<li><a href="#'.$letter.'" tabindex="0">'.$letter.'</a></li>';
            while($row = mysqli_fetch_assoc($query)){
                $newEntry = str_replace("<animal/>",$row['nome'],$animal_entry);
                $newEntry = str_replace("<desc/>",$row['descrizione'],$newEntry);
                $newEntry = str_replace("<status/>",ucfirst($row['status']),$newEntry); 
                $animals .= $newEntry; 
            }
            $newTable = str_replace("<animals/>",$animals,$newTable);
            $all_sections .= $newTable;
            $query->free_result();
        }
    }
    $page = str_replace("<navigator/>", $navigator,$page);
    $page = str_replace("<to-fill/>", $all_sections,$page);
    $mysqli->close();
    
    echo $page;
?>