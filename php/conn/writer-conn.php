<?php
  $db_host = 'localhost';
  $db_user = 'writers';
  $db_password = 'writers';
  $db_db = 'my_elusive';
 
  $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);

  $user;
	
  if ($mysqli->connect_error) {
    $user = "<script>console.log('Writer connection failed.');</script>";
    exit();
  }

  $user = "<script>console.log('Writer connection estabilished.');</script>";
?>