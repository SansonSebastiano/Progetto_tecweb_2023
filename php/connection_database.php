<?php
$host = "localhost";
$user = "root";
$password= "";
$db = "elusive";
$connessione = new mysqli($host,$user,$password,$db);
if (mysqli_connect_errno()) {
    echo "Connessione fallita (". mysqli_connect_errno()
    . "): " . mysqli_connect_error();
    exit();
  }

  echo 'Success: A proper connection to MySQL eLusive was made.';
  echo '<br>';
  echo 'Host information: '.$mysqli->host_info;
  echo '<br>';
  echo 'Protocol version: '.$mysqli->protocol_version;

  //$mysqli->close();
?>


