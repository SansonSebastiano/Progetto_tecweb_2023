<?php
  $db_host = 'localhost';
  $db_user = 'writers';
  $db_password = 'writers';
  $db_db = 'my_elusive';
 
  $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
	
  if ($mysqli->connect_error) {
    echo "<script>console.log('Logged connection failed.');</script>";
    exit();
  }

  echo "<script>console.log('Logged connection estabilished.');</script>";

  //$mysqli->close();
?>