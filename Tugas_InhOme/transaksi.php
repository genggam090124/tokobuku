<?php
session_start();
  if (!isset($_SESSION["id_customer"])) {
      header("location:login_customer.php");
  }

  include("config.php");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <title>Toko Buku</title>
  <link rel="icon" type="image/png" href="logo/favicon-1.png">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link href="fontawsome/css/all.css" rel="stylesheet">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
  <script>
      Detail = (item) =>{
          document.getElementById('kode_buku').value = item.kode_buku;
          document.getElementById('judul').innerHTML = `Title : ${item.judul}`;
          document.getElementById('penulis').innerHTML = `Writer : ${item.penulis}`;
          document.getElementById('stok').innerHTML = `Stock : ${item.stok}`;
          document.getElementById('jumlah_beli').value = "1";

          document.getElementById('image').src = "image/" + item.image;
      }
  </script>
  <style>
      .carousel-inner{
          margin-bottom: 20px;
      }
      .carousel-item{
          filter: brightness(75%);
      }
      body{
          margin: 0px;
          padding: 0px;
      }
      .nav-item{
          margin-left: 25px;
      }
  </style>
   </head>
   <body>
     <?php
     if (isset($_POST["search"])) {
       // code...
       $search = $_POST["search"];
       $sql = "select * from buku where judul like '%$search%' or
       penulis like '%$search%' or harga like '%$search%'";
     }else {

       $sql = "select * from buku";
     }
     $query = msqli_query($connect , $sql);
      ?>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <button type="button" class="navbar-toggler" data-toggle="collapse"
        data-target="#navbarTogglerDemo0" aria-controls="navbarTogglerDemo01"
        aria-expanded="false" aria-label="Toggle Navigation" name="button">
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a href="#" class="nav-link" >
              <img src="logo/segitiga.png" width="65px">
              <span>Toko Buku</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav mt-2 mt-lg-0">
          <li class="nav-item">
            <a href="tokobuku.php" class="nav-link"><i class="fas fa-home"></i></a>
          </li>
          <li class="nav-item">
            <a href="cart.php" class="nav-link"><i class="fas fa-shoping-cart">
            </i>
            (<?php echo count[$_SESSION["cart"]] ?>)
          </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="color : white"><i class="fas fa-envelope"></i></a>
          </li>
          <li class="nav-item dropdown username" style="padding-right:50px;">
            <a href="#" class="nav-link dropdown-toggle" data-Toggle="dropdown" role="button" aria-haspopup="true"
            aria-expanded="false" ><i class="fas fa-user"></i><?php echo $_SESSION["nama"]; ?>
          </a>
          <div class="dropdown-menu">
            <a href="#" class="dropdown-item"><i class="fas fa-user-cog"></i>Pengaturan</a>
            <a href="#" class="dropdown-item"><i class="fas fa-heart"></i>Daftar</a>
            <a href="transaksi.php" class="dropdown-item"><i class="fas fa-money-bill-wave"></i>Trasaksi</a>
            <div class="dropdown-divider"></div>
            <a href="proses_login_customer.php?logout=true" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i>LOGOUT</a>
          </div>
          </li>
        </ul>
      </div>
      </nav>

      <div class="container">
        <div class="card-mt3">
          <div class="card-header bg-dark text-white">
            <h1>Sejarah Transaksi</h1>
          </div>
          <div class="card-body">
            <?php
              $sql = "select * from transaksi t inner join customer c
              on t,id_customer = c.id_customer
              where t.id_customer = '".$_SESSION["id_customer"]"'
              order by t.tgl desc";

              $query = msqli_query($connect, $sql);
             ?>

             <ul class="list-group">
               <?php foreach ($query as $transaksi);?>
               <li class="list-group-item mb-4">
                 <h6>ID Transaksi: <?php echo $transaksi["id_transaksi"]; ?></h6>
                 <h6>Nama : <?php echo $transaksi["nama`"] ?></h6>
                 <h6>Tanggal Transaksi: <?php echo $transaksi["tanggal"] ?></h6>
                 <h6>List Barang</h6>

                 <?php
                    $sql = "select * from detail_transaksi d inner join buku b
                    on d.kode_buku = b.kode_buku
                    where d.id_transaksi = '".$transaksi["id_transaksi"]."'";
                    $query2 = mysqli_query($connect, $sql);
                  ?>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total = 0; foreach($query2 as $detail): ?>
                        <tr>
                          <td><?php echo $detail ["judul"]; ?></td>
                          <td><?php echo $detail ["jumlah"]; ?></td>
                          <td><?php echo number_format($detail["harga_beli"]); ?></td>
                          <td><?php echo number_format($detail["harga_beli"] * $detail["jumlah"]) ?></td>
                        </tr>
                        <?php
                        $total += ($detail["harga_beli"] * $detail["Jumlah"]);
                      endforeach;
                         ?>
                    </tbody>
                  </table>
                  <h6 class="text-danger"> Rp <?php echo number_format($total); ?></h6>
               </li>
             <?php endforeach; ?>
             </ul>
          </div>
        </div>
      </div>
   </body>
 </html>
