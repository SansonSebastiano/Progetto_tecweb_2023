<?php
  $db_host = 'localhost';
  $db_user = 'admin';
  $db_password = 'admin';
  $db_db = 'my_elusive';
 
  $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
	
  if ($mysqli->connect_error) {
    echo "<script>console.log('Admin connection failed.');</script>";
    exit();
  }

  echo "<script>console.log('Admin connection estabilished.');</script>";

  //$mysqli->close();
?>