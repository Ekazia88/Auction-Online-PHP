<?php
include 'config.php';
session_start();
$result = mysqli_query($conn,"SELECT * FROM kategori");
  $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
  $kategori[] = $row;
   }
if (isset($_POST['sub'])) {
    $search=trim($_POST['cari']);
    echo "<script>document.location.href ='search.php?cari=$search';</script>";
}
if(isset($_GET['cari'])){
    $search = trim($_GET['cari']);
    $result2 = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = produk.id_produk 
    join kategori on produk.idcat = kategori.id_kat 
    left join bidder on bid.id_bidders = bidder.id_bidder
    where nama like '%".$search."%' or name_kat like '%".$search."%' order by id_bid asc");           
    $produk = [];
   while($row = mysqli_fetch_assoc($result2)){
   $produk[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="./css/cats.css">
  <script src="./js/script.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/lightslider.css">
  <script type="text/javascript" src="./js/Jquery.js"></script>
  <script type="text/javascript" src="./js/lightslider.js"></script>
  <title>Search</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">   
                <div class="logo">
                    <a href="index.php">Lelo</a>
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
                                    <i class="fa-solid fa-user"></i>
                                    <div class="card hidden">
                                        <ul class="dropdown-profile">
                                          <li><a class="text-profile" href="user-profile.php">Profile</li></a>
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
                
                    <?php if(mysqli_num_rows($result2) == 0){ ?>
                <div class="text-header">
                    <h2><center>Penelurusan ' <?php echo $search?> ' Tidak Ditemukan</h2>

                </div>
                <?php }else{?>
                    
                    <div class="text-header">
                   
                    <h2>Penelurusan '<?php echo $search?>'</h2>
                    
                    
                </div>
                <?php $i= 1;foreach($produk as $prk){?>
                <div class="slider1">
                    <ul id="autoWidth3" class="cS-hidden">
                    <li class="item-3">
                        <div class="box">
                            <div class="slide-img">
                            <img src="./gambar_produk/<?php echo $prk['nama'];?>/<?php echo $prk['gambar_produk'];?>" alt="1">
                            <div class="overlay">
                                <a href="produk.php?id=<?php echo $prk['id_bid'];?>" class="buy-btn">Lelang Sekarang</a>
                            </div>
                            </div>
                            <div class="detail-box">
                                <div class="type">
                                    <a><?php echo $prk['nama'];?></a>
                                    <span><?php echo $prk['name_kat']?></span>
                                </div>
                                <?php if($prk['harga_terakhir'] == 0){?>
                                <a class="price">Rp.<?php echo $prk['harga_awal'];?></a>
                                <?php }else{?>
                                <a class="price">Rp.<?php echo $prk['harga_terakhir'];?></a>
                                <?php } ?>
                                </div>
                        </div>
                    </li>
                    </ul>
                    </div>
                    <?php $i++; } ?>
                    <?php }?>
                </div>	
        </section>
    </body>
    <script>
         $(document).ready(function() {
    $('#autoWidth3').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth3').removeClass('cS-hidden');
        } 
    });  
  });
    </script>
</html>