<?php
  session_start();

  include("config.php");

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_customer"])) {
    // code...
    $sql = "select * from customer where username='$username' and password = '$password'";
    $querry = mysqli_query($connect, $sql);
    $jumlah  = mysqli_query($query);

    if ($jumlah > 0) {
      // code...
      $customer = mysqli_fetch_array($query);

                // membuat session
                $_SESSION["id_customer"] = $customer["id_customer"];
                $_SESSION["nama"] = $customer["username"];
                $_SESSION["cart"] = array();

                header("location:toko_buku.php");

    }else {

      header("location:tokobuku.php")
    }
  }

  if (isset($_GET["logout"])) {
    // code...
    session_destroy();
    header("location:login_customer");
  }
 ?>
