<?php
require '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$sql = mysqli_query($conn, "SELECT * FROM kategori");
$kategori = [];
while($row = mysqli_fetch_assoc($sql)){
  $kategori[] =$row;
}

if(isset($_POST['add'])){
  $nama = $_POST['nama'];
  $hargaawal = $_POST['price'];
  $id_cat = $_POST['cats'];
  $kondisi = $_POST['kondisi'];
  $desc = $_POST['desk'];
  $folder = mkdir("../../gambar_produk/$nama/");
  $target_dir = "../../gambar_produk/$nama/";
  $gambar = $_FILES['myFile']['name'];
  $target_file = $target_dir . basename($_FILES["myFile"]["name"]);

  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $extensions_arr = array("jpg","jpeg","png","gif","webp");

  if( in_array($imageFileType,$extensions_arr) ){
    if(move_uploaded_file($_FILES['myFile']['tmp_name'],$target_dir.$gambar)){
      $sql = "INSERT INTO produk values ('','$nama','$hargaawal','$gambar','$id_cat','$kondisi','$desc')";
      $result = mysqli_query($conn, $sql);
      if($result){
          echo"<script>
                alert('Data Berhasil Ditambahkan');
                document.location.href ='read.php';
                </script>";
      }else{
          echo"<script>
          alert('Data Gagal Ditambahkan');
          document.location.href ='add.php';
          </script>";
      }
    }
  } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/crud.css">
    <!-- Font Icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">
</head>
<body>
<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="./../img/admin-profile.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Admin</span>
                    <span class="text-2">Admin Page</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="../index.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../user/user.php">
                            <i class='bx bxs-user-rectangle icon' ></i>
                            <span class="text nav-text">User</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../kategori/read.php">
                            <i class='bx bxs-category icon' ></i>
                            <span class="text nav-text">Category</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="read.php">
                            <i class='bx bxs-cart icon'></i>
                            <span class="text nav-text">Product</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../lelang/read.php">
                            <i class='bx bxs-briefcase-alt-2 icon'></i>
                            <span class="text nav-text">Lelang</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../bid/read.php">
                            <i class='bx bx-book icon'></i>
                            <span class="text nav-text">Bid Status</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="bottom-content">
                <li class="nav-link">
                    <a href="../../Auth/logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <section class="main">
        <div class="text">Produk Management / Add</div>
        <div class="content">
            <h1>Add Data</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="container">          
                  <label for="name"><b>Nama</b></label>
                  <input type="text" placeholder="Masukkan Nama" name="nama" required>

                  <label for="price"><b>Harga Awal</b></label>
                  <input type="number" placeholder="Masukkan Harga" class="form-control" name="price"required>
                  <label for="image"><b>Gambar</b></label>
                  <div class="drop-zone">
                    <span class="drop-zone__prompt">Klik / taro Disini Untuk Masukkan Gambar</span>
                    <input type="file" name="myFile" class="drop-zone__input">
                  </div>
                  <label for="name"><b>Kategori</b></label>
                  <select id="cats" name="cats" class="form-control">
                    <?php $i =  1; foreach ($kategori as $kat):?>
                        <?php $i;?>
                    <option value="<?php echo $kat['id_kat'];?>"><?php echo $kat['name_kat'];?></option>
                    <?php $i++; endforeach; ?>
                  </select>
                  <label for="name"><b>Kondisi</b></label>
                  <select id="kondisi" name="kondisi" class="form-control">
                    <option value="firsthand">Firsthand</option>
                    <option value="seconhand">Secondhand</option>
                    <option value="rusak">Rusak</option>
                </select>
                  <label for="username"><b>Deskripsi</b></label>
                  <textarea name="desk" cols="30" rows="10" class="form-control"placeholder="Tulis Deskripsi"></textarea>
                  <hr>      
                  <button type="submit" name="add"class="registerbtn">add</button>
                </div>
              </form>
            </div>
        </div>
    </section>
</body>
<script src="../js/main.js"></script>

</html>
