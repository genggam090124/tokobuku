<?php
  include("login.php");
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script type="text/javascript">
      Add = () => {
        document.getElementById('action').value = "insert";
        document.getElementById('id_admin').value = "";
        document.getElementById('nama').value = "";
        document.getElementById('kontak').value = "";
        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
      }

      Edit = (item) =>{
       document.getElementById('action').value = "update";
       document.getElementById('id_admin').value = item.id_admin;
       document.getElementById('nama').value = item.nama;
       document.getElementById('kontak').value = item.kontak;
       document.getElementById('username').value = item.username;
       document.getElementById('password').value = item.password;
       }

      Delete = () => {

      }
    </script>
  </head>
  <body>
    <?php
   $sql = "select * from admin";
   $query = mysqli_query($connect, $sql);
 ?>

 <div class="container">
   <div class="card">
     <div class="card-header bg-secondary text-white">
       <h4>Data Admin</h4>
     </div>
     <div class="card-body">
       <table class="table" border="1">
         <thead>
           <tr>
             <th>Id Admin</th>
             <th>Nama</th>
             <th>Kontak</th>
             <th>Username</th>
             <th>Password</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($query as $admin): ?>
             <tr>
               <td><?php echo $admin["id_admin"]?></td>
               <td><?php echo $admin["nama"]?></td>
               <td><?php echo $admin["kontak"]?></td>
               <td><?php echo $admin["username"]?></td>
               <td><?php echo $admin["password"]?></td>
               <td>
                 <button type="button" data-toggle="modal" data-target="#modal_admin" class="btn btn-sm btn-info"
                 onclick='Edit(<?php echo json_encode($admin); ?>)'>
                   Edit
                 </button>
                 <a href="crud.php?hapus=true&id_admin=<?php echo $admin["id_admin"]; ?>" onclick="return confirm('Apakah Anda Yakin')">
                   <button type="button" data-toggle="modal" data-target="#modal_admin" class="btn btn-sm btn-danger" onclick="Delete()">
                     hapus
                   </button>
                 </a>
               </td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
         <button data-toggle="modal" data-target="#modal_admin" type="button" class="btn btn-sm btn-secondary" onclick="Add()">
           Tambah Data
         </button>
       </div>
   </div>
         <div class="modal fade" id="modal_admin">
           <div class="modal-dialog">
             <div class="modal-content">
               <form action="crud.php" method="post" enctype="multipart/form-data">
                 <div class="modal-header bg-danger text-white">
                   <h4>Form Admin</h4>
                 </div>
                 <div class="modal-body">
                   <input type="hidden" name="action" id="action">
                   Id Admin
                   <input type="number" name="id_admin" id="id_admin" class="form-control" required />
                   Nama
                   <input type="text" name="nama" id="nama" class="form-control" required />
                   Kontak
                   <input type="number" name="kontak" id="kontak" class="form-control" required />
                   Username
                   <input type="text" name="username" id="username" class="form-control" required />
                   Password
                   <input type="text" name="password" id="password" class="form-control" required />
                 </div>
                 <div class="modal-footer">
                   <button type="submit" name="save_admin" class="btn btn-secondary">Simpan</button>
                 </div>
               </form>
           </div>
       </div>
   </div>
</div>
  </body>
</html>
