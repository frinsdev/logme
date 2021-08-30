<?php

  $db_host = 'sql103.epizy.com';
  $db_username = 'epiz_29573972'; 
  $db_password = 'QYwB6TWdPN';
  $db_name = 'epiz_29573972_logme';

  $conn = mysqli_connect($db_host, $db_username, $db_password);
  $db_select = mysqli_select_db($conn, $db_name);

  if(!$conn || !$db_select) {
    die("Database connection failed: " . mysqli_err($conn));
  }

?>
