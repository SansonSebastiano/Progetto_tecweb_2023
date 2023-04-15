<?php
  $db_host = 'localhost';
  $db_user = 'logged';
  $db_password = 'logged';
  $db_db = 'my_elusive';
 
  $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);

  $user;
	
  if ($mysqli->connect_error) {
    $user = "<script>console.log('Logged connection failed.');</script>";
    exit();
  }

  $user = "<script>console.log('Logged connection estabilished.');</script>";

  //$mysqli->close();
?>