<?php

  $db_host = '';
  $db_username = ''; 
  $db_password = '';
  $db_name = '';

  $conn = mysqli_connect($db_host, $db_username, $db_password);
  $db_select = mysqli_select_db($conn, $db_name);

  if(!$conn || !$db_select) {
    die("Database connection failed: " . mysqli_err($conn));
  }

?>
