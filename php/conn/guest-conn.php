<?php
  $db_host = 'localhost';
  $db_user = 'guest';
  $db_password = 'guest';
  $db_db = 'my_elusive';
 
  $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);

  $user;
	
  if ($mysqli->connect_error) {
    $user = "<script>console.log('Guest connection failed.');</script>";
    exit();
  }

  $user = "<script>console.log('Guest connection established.');</script>";
?>