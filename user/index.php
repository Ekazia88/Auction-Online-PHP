<?php
include '../config.php';
session_start();

$id = $_SESSION['id_user'];
if($_SESSION['level'] != "user"){
    echo "<script>alert('Anda harus login!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
if (isset($_POST['sub'])) {
    $search=trim($_POST['cari']);
    $sql="SELECT * FROM bid inner join produk on bid.id_products = id_produk join kategori on produk.idcat = kategori.id_kat where name_kat like '%".$search."%' or nama like '%".$search."%' ";
    $result = mysqli_query($conn,$sql);
    $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
    $kategori[] =$row;
  }
  if($result){
    foreach($kategori as $kat){
    $katx = $kat['id_bid'];
    echo "<script>document.location.href ='search.php?cari=$katx';</script>";
    }
  }
}
// include 'autoupdate.php';
$now = date("Y-m-d");
$result = mysqli_query($conn,"SELECT * FROM Kategori");
  $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
  $kategori[] = $row;
   }
$result2 = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = id_produk join kategori on produk.idcat = kategori.id_kat");
   $produk = [];
   while($row = mysqli_fetch_assoc($result2)){
   $produk[] = $row;
    }
    $timezone = new DateTimeZone('Asia/Singapore');
    $today = new DateTime();
    $today = $today->setTimezone($timezone);
?>
<html>
<head>
<title>LELO - Lelang online </title>  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>   
<link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">
<link rel="stylesheet" type="text/css" href="../css/lightslider.css">
<script type="text/javascript" src="../js/Jquery.js"></script>
<script type="text/javascript" src="../js/lightslider.js"></script>
</head>  
  <body>
    <div class="wrapper">
        <header>
            <div class="container">   
                <div class="logo">
                    <a href="index.php">Lelo </a>
                </div>
                <form action=""  name="sub" method="post">
                <div class="search-cat-section">
                    <div class="searchdrop">
                        
                        <input type="text" placeholder="Search" name="cari" />
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
                        <button title="Search" value="" name ="sub" type="submit"></button>
                        </form>
                    </div>
                </div>
                <nav id="navbar">
                        <ul>
                            <li>
                                <div class="profile" onclick="menuToggle();">
                                    <i class='bx bxs-user icon'></i>
                                    <div class="card hidden">
                                        <ul class="dropdown-profile">
                                          <li><a class="text-profile" href="user-profile.php">Profile</li></a>
                                          <li><a class="text-profile" href="../Auth/logout.php">Log Out</li></a>
                                        </ul>
                                </div>
                            </li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                </nav>
            </div>
        </header>
        <section class="content-header">
            <img src="../img/banner-1.jpeg" alt="">
        </section>
        <div class="front-list-cat" class="lft-list">
            <h4 class="pad-10">
                Categories 
            </h4>
            <ul class="pad-10">
            <?php $i=1; foreach($kategori as $kat):?>
                <li>
                    <a href="cats.php?id=<?php echo $kat['id_kat']?>"class="cat-item"><?php echo $kat['name_kat']?></a>
                </li>
                    <?php $i++; endforeach;?>
            </ul>
    </div>
                    <section class="content"> 
                        
                    <?php $i=1; foreach($produk as $prk):?>   
            <?php $datelast = new DateTime(date($prk['tanggal_berakhir']));?>
            <?php $cdays = $datelast->diff($today)->days;?>
            <?php $x = new DateTime(date($prk['tanggal_dimulai']));?>
            <?php $cdaysbegin =  $x->diff($today)->days;?>
            <?php if($prk['status'] == "dibuka"){?>
            <?php if($cdaysbegin == 0){?>
            <div class="mainbox">
                <div class="text-header">
                    <h2>New Added</h2>
                </div>
                <div class="slider1">
                    <ul id="autoWidth1" class="cS-hidden">
                    <li class="item-<?php echo $i ?>">
                        <div class="box">
                            <div class="slide-img">
                            <img src="../gambar_produk/<?php echo $prk['nama'];?>/<?php echo $prk['gambar_produk'];?>" alt="1">
                            <div class="overlay">
                                <a href="produk.php?id=<?php echo $prk['id_bid'];?>" class="buy-btn">Lelang Sekarang</a>
                            </div>
                            </div>
                            <div class="detail-box">
                                <div class="type">
                                    <a><?php echo $prk['nama'];?></a>
                                    <span><?php echo $prk['name_kat']?></span>
                                </div>
                                <?php if($prk['harga_terakhir'] == 0):?>
                                   <?php $currency = number_format($prk['harga_awal'],2,',','.');?>
                                <a class="price">Rp. <?php echo $currency;?></a>
                                <?php else:?>
                                    <?php $currency = number_format($prk['harga_terakhir'],2,',','.');?>
                                <a class="price">Rp. <?php echo $currency;?></a>
                                <?php endif?>
                                </div>
                        </div>
                    </li>
                    </ul>
                    </div>
                </div>
            <?php }elseif($cdays == 1 ){?>
                <div class="mainbox">
                <div class="text-header">
                    <h2>One day</h2>
                </div>
                <div class="slider1">
                    <ul id="autoWidth2" class="cS-hidden">
                    <li class="item-2<?php echo $i ?>">
                        <div class="box">
                            <div class="slide-img">
                            <img src="../gambar_produk/<?php echo $prk['nama'];?>/<?php echo $prk['gambar_produk'];?>" alt="1">
                            <div class="overlay">
                                <a href="produk.php?id=<?php echo $prk['id_bid'];?>" class="buy-btn">Lelang Sekarang</a>
                            </div>
                            </div>
                            <div class="detail-box">
                                <div class="type">
                                    <a><?php echo $prk['nama'];?></a>
                                    <span><?php echo $prk['name_kat']?></span>
                                </div>
                                <?php if($prk['harga_terakhir'] == 0):?>
                                <a class="price">Rp.<?php echo $prk['harga_awal'];?></a>
                                <?php else:?>
                                <a class="price">Rp.<?php echo $prk['harga_terakhir'];?></a>
                                <?php endif;?>
                                </div>
                        </div>
                    </li>
                    </ul>
                    </div>
                </div>
                  <?php }?>
                <?php }elseif($prk['status'] == "ditutup"){ ?>
                    <div class="mainbox">
                <div class="text-header">
                    <h2>closed</h2>
                </div>
                <div class="slider1">
                    <ul id="autoWidth3" class="cS-hidden">
                    <li class="item-3<?php echo $i ?>">
                        <div class="box">
                            <div class="slide-img">
                            <img src="../gambar_produk/<?php echo $prk['nama'];?>/<?php echo $prk['gambar_produk'];?>" alt="1">
                            <div class="overlay">
                                <a href="produk.php?id=<?php echo $prk['id_bid'];?>" class="buy-btn">Lelang Sekarang</a>
                            </div>
                            </div>
                            <div class="detail-box">
                                <div class="type">
                                    <a><?php echo $prk['nama'];?></a>
                                    <span><?php echo $prk['name_kat']?></span>
                                </div>
                                <?php if($prk['harga_terakhir'] == 0):?>
                                <a class="price">Rp.<?php echo $prk['harga_awal'];?></a>
                                <?php else:?>
                                <a class="price">Rp.<?php echo $prk['harga_terakhir'];?></a>
                                <?php endif;?>
                                </div>
                        </div>
                    </li>
                    </ul>
                    </div>
                </div>	
                <?php }?>
                 <?php $i++; endforeach;?>
        </section>
    </div>
  </body>
  <script type="text/javascript">
   $(document).ready(function() {
    $('#autoWidth1').lightSlider({
        pause:1000,
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth1').removeClass('cS-hidden');
        } 
    });  
  });
  $(document).ready(function() {
    $('#autoWidth2').lightSlider({
        pause: 1000,
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth2').removeClass('cS-hidden');
        } 
    });  
  });
  $(document).ready(function() {
    $('#autoWidth3').lightSlider({
        pause: 9000,
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth3').removeClass('cS-hidden');
        } 
    });  
  });
  function menuToggle(){
        let card = document.querySelector(".card"); //declearing profile card element
        let displayPicture = document.querySelector(".profile"); 

        displayPicture.addEventListener("click", function() { //on click on profile picture toggle hidden class from css
        card.classList.toggle("hidden")})
    }
  </script>
</html>