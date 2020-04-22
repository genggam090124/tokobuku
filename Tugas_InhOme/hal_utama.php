<?php
    session_start();
    if(!isset($_SESSION["id_customer"])){
        header("location:login_customer.php");
    }
    include "config.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            Purchase = (item) => {
                document.getElementById('kode_buku').value = item.kode_buku;
                document.getElementById("judul").innerHTML = item.judul;
                document.getElementById("penulis").innerHTML ="penulis : " + item.penulis;
                document.getElementById("harga").innerHTML ="harga : " + item.harga;
                document.getElementById("stok").innerHTML ="stok : " + item.stok;
                document.getElementById("jumlah_beli").value = "1";
                document.getElementById("image").src = "image/" + item.image;
            }
        </script>
  </head>
  <body>
    <!-- Header Start !!!! -->
    <div class="jumbotron text-center " style="marginbottom:0">
      <h1>Toko Buku</h1>
      <p>Grosir Buku Murah Ea....</p>
    </div>
    <!-- Header End -->


    <!-- Nav Start -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top ">
      <a class="nav-brand" href="#">
        <img src="" alt="" width="40px">
      </a>
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="proses_login_customer.php">
            <?php echo $_SESSION["nama"]; ?> | LogOut
          </a>
        </li>
        <li class="nav-item">
          <a class="" href="#"></a>
        </li>
      </ul>
    </nav>
  </body>
</html>
