<?php
include '../config.php';
session_start();
if($_SESSION['level'] != "user"){
    echo "<script>alert('Anda harus login!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$id = $_GET['cari'];
$result = mysqli_query($conn,"SELECT * FROM kategori");
  $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
  $kategori[] = $row;
   }
    $result2 = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = id_produk join kategori on produk.idcat = kategori.id_kat where id_bid = $id");           
    $produk = [];
   while($row = mysqli_fetch_assoc($result2)){
   $produk[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../css/cats.css">
  <script src="../js/script.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/lightslider.css">
  <script type="text/javascript" src="../js/Jquery.js"></script>
  <script type="text/javascript" src="../js/lightslider.js"></script>
  <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">   
                <div class="logo">
                    <a href="">Lelo</a>
                </div>
                <div class="search-cat-section">
                    <div class="searchdrop">
                        <input type="text" placeholder="Search" />
                        <div class="cat">
                            <a href="#">
                                <span>Category
                                <i class="fa-sharp fa-solid fa-chevron-down"></i>
                            </span>
                            </a>
                            <div class="cat-menu">
                            <span class="subject">Select Category</span>
                                <?php $i=1; foreach($kategori as $kat):?>
                                <a href="Cats.php?id=<?php echo $kat['id_kat']?>" class="menu-item-cat"><?php echo $kat['name_kat']?></a>
                                <?php $i++; endforeach;?>
                            </div>
                        </div>
                        <input title="Search" value="" type="button" />
                    </div>
                </div>
                <nav id="navbar">
                        <ul>
                            <li>
                                <div class="profile" onclick="menuToggle();">
                                    <i class="fa-solid fa-user"></i>
                                    <div class="card hidden">
                                        <ul class="dropdown-profile">
                                          <li><a class="text-profile" href="user-profile.php">Profile</li></a>
                                          <li><a class="text-profile" href=".../Auth/logoutphp">Log Out</li></a>
                                        </ul>
                                </div>
                            </li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#" >Login / Register</a></li>
                        </ul>
                </nav>
            </div>
        </header>
        <section class="content-cats">
            <div class="mainbox">
                <div class="text-header">
                    <h2>Penelurusan <?php echo $produk['nama']?></h2>
                </div>
                <div class="slider1">
                    <ul id="autoWidth3" class="cS-hidden">
                    <li class="item-3">
                        <div class="box">
                            <div class="slide-img">
                            <img src="../gambar_produk/<?php echo $produk['nama'];?>/<?php echo $produk['gambar_produk'];?>" alt="1">
                            <div class="overlay">
                                <a href="produk.php?id=<?php echo $produk['id_bid'];?>" class="buy-btn">Lelang Sekarang</a>
                            </div>
                            </div>
                            <div class="detail-box">
                                <div class="type">
                                    <a><?php echo $produk['nama'];?></a>
                                    <span><?php echo $produk['name_kat']?></span>
                                </div>
                                <?php if($produk['harga_terakhir'] == 0):?>
                                <a class="price">Rp.<?php echo $produk['harga_awal'];?></a>
                                <?php else:?>
                                <a class="price">Rp.<?php echo $produk['harga_terakhir'];?></a>
                                <?php endif;?>
                                </div>
                        </div>
                    </li>
                    </ul>
                    </div>
                </div>	
        </section>
    </body>
    <script>
    </script>
</html>