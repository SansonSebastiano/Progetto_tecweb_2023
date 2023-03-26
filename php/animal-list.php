<?php

require_once("." . DIRECTORY_SEPARATOR . "connection_database.php");
$table = file_get_contents(".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "letter-table.html");
$animal_entry = file_get_contents(".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "animal-entry.html");
$page = file_get_contents(".." . DIRECTORY_SEPARATOR . "html" . DIRECTORY_SEPARATOR . "animal-list.html");

$alphas = range('A', 'Z');

$sql = "SELECT nome,descrizione,status FROM animale WHERE nome REGEXP '^[^a-zA-Z]' ORDER BY nome ASC;";
$query = mysqli_query($connessione, $sql);
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
    $final = str_replace("<letterTitle/>","#",$final);
    $navigator .= '<li><a href="#hash">#</a></li>';
    while($row = mysqli_fetch_assoc($query)){
        $newEntry = str_replace("<animal/>",$row['nome'],$animal_entry);
        $newEntry = str_replace("<desc/>",$row['descrizione'],$newEntry);
        $newEntry = str_replace("<status/>",ucfirst($row['status']),$newEntry); 
        $animals .= $newEntry; 
    }
    $query->free_result();
}
$final = str_replace("<animals/>",$animals,$final);

foreach($alphas as $letter){
    $sql = "SELECT nome,descrizione,status FROM animale WHERE LOWER(nome) REGEXP '^" . $letter . "' ORDER BY nome ASC;";
    $query = mysqli_query($connessione, $sql);
    $animals = "";
    if($query->num_rows > 0){
        $newTable = str_replace("<letter/>",$letter,$table);
        $newTable = str_replace("<letterTitle/>",$letter,$table);
        $navigator .= '<li><a href="'.$letter.'">'.$letter.'</a></li>';
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
$page = str_replace("<navigator/>",$navigator,$page);
$page = str_replace("<ToFill/>",$final,$page);
$connessione->close();
echo $page;
?>