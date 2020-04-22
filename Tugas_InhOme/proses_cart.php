<?php
  session_start();
  include("config.php");

  if (isset($_POST["add_to_cart"])) {
    //mtamoung kode buku dan jumlah belinya
    $kode_buku =  $_POST["kode_buku"];
    $jumlah_beli  = $_POST["jumlah_beli"];

    //ambil data buku dari database swsuaii dengan kode buuku yg dipilih
    $sql "select * from buku where kode_buku = '$kode_buku'";
    $query = mysqli_query($connect, $sql);
    $buku = mysqli_fetch_array($query);

    $item = [
      "kode_buku" => $buku ["kode_buku"],
      "judul" => $buku ["judul"],
      "image" => $buku["image"],
      "harga" => $buku["harga"],
      "jumlah_beli" => $jumlah_beli
    ];
  }

  //menghapus item cart
  if (isset($_GET["hapus"])) {
    //tampung data kode_buku yang akan dihapus
    $kode_buku = $_GET["kode_buku"];

    //cari index cart yg sesuai dengan kode_buku yg akan dihapus
    $index = array_search(
      $kode_buku, array_column(
        $_SESSION["cart"], "kode_buku"
        )
      );

      //hapus item pada array
      array_splice($_SESSION["cart"], $index, 1);
      header("location:cart.php");
  }

  //chekout
  if (isset($_GET["checkout"])) {
    // memasukan data pada target cert ke database
    //transaksi  -> id_trannsaksi , tgl , id_customer
    //detail -> id_transaksi , kode_buku ,jumlah , harga beli
    $id_transaksi = "ID".rand(1,1000);

    // Y = Year, m = month, d = day, H = Hours, i = minute, s = second
    $tgl = date("Y-m-d-H:i:s");
    $id_customer = $_SESSION["id_customer"];

     $sql = "insert * into transaksi values ('$id_transaksi', '$tgl', '$id_customer')";


            foreach ($_SESSION["cart"] as $cart){
                $kode_buku = $cart["kode_buku"];
                $jumlah = $cart["jumlah_beli"];
                $harga_beli = $cart["harga"];

                // create query insert into detail table
                $sql = "insert into detail_transaksi values ('$id_transaksi', '$kode_buku', '$jumlah', '$harga_beli')";
                mysqli_query($connect, $sql);

                $sql2 = "update buku set stok = stok - $jumlah where kode_buku = '$kode_buku'";
                mysqli_query($connect, $sql2);
            }
            // kosongkan cart nya
            $_SESSION["cart"] = array();
            header("location:transaksi.php");
  }

 ?>
