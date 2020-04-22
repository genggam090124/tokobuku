<?php
  // connect ke databaase
  $host = "localhost";
  $username = "root";
  $password = "";
  $db = "tokobuku"
  $connect =msqli_connect($host, $username, $password, $db);

  if (mysqli_connect_errno()) {
    // code...
    echo mysqli_connect_error() ;
  }
 ?>
