<?php
require '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM produk where id_produk = $id");
$prk = [];
while($row = mysqli_fetch_assoc($result)){
  $prk[] =$row;
}
$prk = $prk[0];
if(isset($_POST['ubah'])){
    function rrmdir($olddir) { 
        foreach(glob($olddir . '/*') as $file) { 
            if(is_dir($file)) rrmdir($file); else unlink($file); 
         } rmdir($olddir); 
    }
   
    
    $oldpic = $_POST['oldpict'];
    $olddir = "../../gambar_produk/$oldpic/";
    if(file_exists($olddir)){
        rrmdir($olddir);
    }else{
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $hargaawal = $_POST['price'];
        $id_cat = $_POST['cats'];
        $desc = $_POST['desk'];
        $folder = mkdir("../../gambar_produk/$nama/");
        $target_dir = "../../gambar_produk/$nama/";
            $newpict = $_FILES['myFile']['name'];
            $target_file = $target_dir . basename($_FILES["myFile"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif","webp");   
            if( in_array($imageFileType,$extensions_arr) ){
                if(move_uploaded_file($_FILES['myFile']['tmp_name'],$target_dir.$newpict)){
                $sql = "update produk set nama ='$nama',harga_awal ='$hargaawal',gambar_produk = '$newpict',idcat = '$id_cat',deskripsi='$desc' where id_produk = $id";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo"<script>
                    alert('Data Berhasil Diubah');
                    document.location.href ='read.php';
                    </script>";
                }else{
                    echo"<script>
                    alert('Data Gagal Diubah');
                    </script>";
                }
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
                        <a href="../user/read.php">
                            <i class='bx bxs-user-rectangle icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="read.php">
                            <i class='bx bxs-category icon' ></i>
                            <span class="text nav-text">Category</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../produk/read.php">
                            <i class='bx bxs-cart icon'></i>
                            <span class="text nav-text">Product</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../lelang/read.php">
                            <i class='bx bxs-briefcase-alt-2 icon'></i>
                            <span class="text nav-text">Bidding</span>
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
                <li class="">
                    <a href="../../Auth/logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>          
            </div>
        </div>
    </nav>
    <section class="main">
        <div class="text">Produk Management / Edit</div>
        <div class="content">
            <h1>Update Data</h1>
            <form action="" method = "POST" enctype="multipart/form-data">
                <div class="container">
                    <input type="hidden" name="id" value="<?php echo $prk['id_produk']?>"> 
                  <input type="hidden" name="oldpict" value="<?php  echo $prk["nama"];?>">         
                  <label for="name"><b>Nama</b></label>
                  <input type="text" placeholder="Masukkan Nama" name="nama" value="<?php echo $prk['nama'] ?>" required>
                  <label for="price"><b>Harga Awal</b></label>
                  <input type="number" placeholder="Masukkan Harga" class="form-control" name="price" value="<?php echo $prk['harga_awal'] ?>"required>
                  <label for="pict"><b>Gambar</b></label>
                  <div class="drop-zone">
                    <span class="drop-zone__prompt">Drop file here or click to upload</span>
                    <input type="file" name="myFile" class="drop-zone__input">
                  </div>


                  <label for="cat"><b>Kategori</b></label>
                  <select id="cats" name="cats" class="form-control">
                    
                    <?php
                    $result = mysqli_query($conn,"SELECT * FROM kategori");
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option  value='".$row['id_kat']."'>".$row['name_kat']."</option>";
                    }
                    ?>
                  </select>
                  <label for="kondisi"><b>Kondisi</b></label>
                  <select id="kondisi" name="kondisi" class="form-control"> 
                    <?php if($prk['kondisi'] == 'firsthand'):?>
                    <option  value="<?php echo $prk['kondisi']?>"selected><?php echo $row['kondisi']?></option>
                    <option value="seconhand">seconhand</option>
                    <option value="rusak">rusak</option>
                    <?php elseif($prk['kondisi'] == 'seconhand'):?>
                    <option value='<?php echo $prk['kondisi']?>'selected><?php echo $prk['kondisi']?></option>
                    <option value="firsthand">firsthand</option>
                    <option value="rusak">rusak</option>
                    <?php else:?>
                    <option  value="<?php echo $prk['kondisi']?>"selected><?php echo $prk['kondisi']?></option>
                    <option value="firsthand">firsthand</option>
                    <option value="seconhand">seconhand</option>
                    <?php endif;?>  
                </select>
                  <label for="desk"><b>Deskripsi</b></label>
                  <textarea name="desk" id="" cols="30" rows="10" class="form-control"placeholder="Tulis Deskripsi" ><?php echo $prk['deskripsi'];?></textarea>
                  <hr>      
                  <button type="submit"  name="ubah"class="registerbtn">Update</button>
                </div>
              </form>
            </div>
        </div>
    </section>
</body>
<script src="../js/main.js"></script>
</html>
