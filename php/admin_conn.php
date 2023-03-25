<?php
  $db_host = 'localhost';
  $db_user = 'admin';
  $db_password = 'admin';
  $db_db = 'my_elusive';
 
  $mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
	
  if ($mysqli->connect_error) {
    echo "<script>console.log('Admin connection failed.');</script>";
    echo "<script>console.log('Errno: '.$mysqli->connect_errno');</script>";
    echo "<script>console.log('Error: '.$mysqli->connect_error');</script>";
    exit();
  }

  echo "<script>console.log('Admin connection estabilished.');</script>";

  //$mysqli->close();
?>