<?php
    include ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
    require ".." . DIRECTORY_SEPARATOR . "check-conn.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION["prev_page"] = $animal_list_ref;

    $table = file_get_contents($modules_path . "letter-table.html");
    $animal_entry = file_get_contents($modules_path . "animal-entry.html");
    $page = file_get_contents($html_path . "animal-list.html");

    $page = str_replace("<greet/>", "Ciao, ", $page);
    $page = str_replace("<user-img/>", $icon_user_ref, $page);
    $page = str_replace("<user/>", $_SESSION["username"], $page);
    $page = str_replace("<log-in-out/>", $log_in_out, $page);
    $page = str_replace("<script-conn/>", $user, $page);

    $alphas = range('A', 'Z');

    $sql = "SELECT nome,descrizione,status FROM animale WHERE nome REGEXP '^[^a-zA-Z]' ORDER BY nome ASC;";
    $query = mysqli_query($mysqli, $sql);
    $row = "";

    if(is_null($query)){
        echo "<h1>Errore durante la connesione al server</h1>";
        die(1);
    }

    $navigator = "";
    $animals = "";
    if($query->num_rows > 0){
        $final = str_replace("Animali che iniziano con <letter/>","Animali che iniziano con caratteri non alfabetici",$table);
        $final = str_replace("<letter/>","hash",$final);
        $final = str_replace("<letter-title/>","#",$final);
        $navigator .= '<li><a href="#hash">#</a></li>';
        while($row = mysqli_fetch_assoc($query)){
            $newEntry = str_replace("<animal/>",$row['nome'],$animal_entry);
            $newEntry = str_replace("<desc/>",$row['descrizione'],$newEntry);
            $newEntry = str_replace("<status/>",ucfirst($row['status']),$newEntry); 
            $animals .= $newEntry; 
        }
        $query->free_result();
    }
    $final = str_replace("<animals/>", $animals,$final);

    foreach($alphas as $letter){
        $sql = "SELECT nome,descrizione,status FROM animale WHERE LOWER(nome) REGEXP '^" . $letter . "' ORDER BY nome ASC;";
        $query = mysqli_query($mysqli, $sql);
        $animals = "";
        if($query->num_rows > 0){
            $newTable = str_replace("<letter/>",$letter,$table);
            $newTable = str_replace("<letter-title/>",$letter,$table);
            $navigator .= '<li><a href="'.$letter.'" tabindex="3">'.$letter.'</a></li>';
            while($row = mysqli_fetch_assoc($query)){
                $newEntry = str_replace("<animal/>",$row['nome'],$animal_entry);
                $newEntry = str_replace("<desc/>",$row['descrizione'],$newEntry);
                $newEntry = str_replace("<status/>",ucfirst($row['status']),$newEntry); 
                $animals .= $newEntry; 
            }
            $newTable = str_replace("<animals/>",$animals,$newTable);
            $final .= $newTable;
            $query->free_result();
        }
    }
    $page = str_replace("<navigator/>", $navigator,$page);
    $page = str_replace("<to-fill/>", $final,$page);
    $mysqli->close();
    
    echo $page;
?>