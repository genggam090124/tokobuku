<?php
  session_strat();

  include("conffig.php");
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_admin"])) {
    // code...
    //mengeksekusi query
    $sql "select * from admin where username = '$username' and password = '$password'";
    $query = mysqli_query($connect, $sql);

    //digunakan untuk mmenghitung jumlah data hasil dari query
    $jumlah = mysqli_num_rows($query);

    if ($jumlah > 0) {
      //mengubah hasil query ke array
      $admin = mysqli_fetch_array($querry);
      //membuat session
      $_SESSION["id_admin"] = $admin["id_admin"];
      $_SESSION["nama"] = $admin["username"];
      header("location:tokobuku.php")
    }else {
      header("location:login_admin.php");
    }
  }
  // Ini adalah proses untuk logout admin
  if (isset($_GET["logout"])) {
    session_destroy();
    header("location:login_admin.php")
  }
 ?>
