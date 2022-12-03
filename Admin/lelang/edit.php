<?php
require '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$ids = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = produk.id_produk = kategori.id_kat
                                join kategori on produk.idcat = kategori.id_kat
                                left join bidder on  bid.id_bidders = bidder.id_bidder
                                where id_bid = $ids");
$bid =[];
while($row = mysqli_fetch_assoc($result)){
  $bid[] = $row;
}

$bid = $bid[0];

if(isset($_POST['update'])){
  $id =$_POST['id'];
  $nama = $_POST['status'];
  $dibuka = $_POST['dtstart'];
  $ditutup = $_POST['dtend'];
  $sql = "UPDATE bid SET tanggal_dimulai = '$dibuka', tanggal_berakhir ='$ditutup', status = '$nama' where id_bid = $id";
  $result = mysqli_query($conn,$sql);

  if($result){
    echo"<script>
        alert('Data User Berhasil Diubah');
        document.location.href ='read.php';
        </script>";
  }else{
    echo"<script>
    alert('Data User Gagal Diubah');
    document.location.href ='edit.php?id=$id';
    </script>";
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
                        <a href="../produk/read.php">
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
        <div class="text">Lelang / Update Lelang</div>
        <div class="content">
            <h1>Ubah Data</h1>
            <form action="" method="post">
                <div class="container">
                   <input type="hidden" name="id" value="<?php echo $bid['id_bid'] ?>"> 
                <label for="status"><b>Nama Produk</b></label>

                    <div class="form-control"><?php echo $bid['nama'] ?></div>          
                    
                  <label for="name"><b>Tanggal Dimulai</b></label>
                  <input type="datetime-local" name="dtstart" value="<?php echo $bid['tanggal_dimulai']?>"class="form-control">

                  <label for="name"><b>Tanggal Berakhir</b></label>
                  <input type="datetime-local" name="dtend" id="" value="<?php echo $bid['tanggal_berakhir']?>" class="form-control">
                  <label for="status"><b>Status</b></label>
                  <select id="produk" name="status" class="form-control" >
                  <option value disabled selected>Pilih Status</option>
                      <option value="dibuka">Dibuka</option>
                      <option value="ditutup">Ditutup</option>
                  </select>
                  <hr>      
                  <button type="submit" name="update"class="registerbtn">Ubah Data</button>    
                </div>
              </form>
            </div>
        </div>
    </section>
</body>
<script>
const body = document.querySelector('body'),
  sidebar = body.querySelector('nav'),
  toggle = body.querySelector(".toggle"),
  modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
sidebar.classList.toggle("close");
})

</script>
</html>
