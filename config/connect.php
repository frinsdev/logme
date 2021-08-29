<?php

  $db_host = 'localhost';
  $db_username = 'root'; 
  $db_password = 'root';
  $db_name = 'logme';

  $conn = mysqli_connect($db_host, $db_username, $db_password);
  $db_select = mysqli_select_db($conn, $db_name);

  if(!$conn || !$db_select) {
    die("Database connection failed: " . mysqli_err($conn));
  }

?>