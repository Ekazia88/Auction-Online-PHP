<?php
include '../config.php';
session_start();
if($_SESSION['level'] != "user"){
    echo "<script>alert('Anda harus login!!!');
    document.location.href ='.../index.php?pesan=gagal';</script>";
}
$idx = $_SESSION['id_user'];
// include 'autoupdate.php';
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM kategori");
  $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
  $kategori[] = $row;
   }
    $result2 = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = id_produk 
    join kategori on produk.idcat = kategori.id_kat where id_bid  = $id");           
   $produk = [];
   while($row = mysqli_fetch_assoc($result2)){
   $produk[] = $row;
}

   $sql1=mysqli_query($conn,"SELECT * from history join bid on history.idbid = bid.id_bid
         join produk on bid.id_products = produk.id_produk
         join bidder on history.idbidder = bidder.id_bidder 
         join users on bidder.id_user = users.id_user where idbid = $id");
         $users = [];
     while($row = mysqli_fetch_assoc($sql1)){
        $users[] = $row;
         }
    $timezone = new DateTimeZone('Asia/Singapore');
    $today = new DateTime();
    $today = $today->setTimezone($timezone);
    $produk = $produk[0];
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/lightslider.js"></script>
<script type="text/javascript" src="../js/script.js"></script>
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
                                    <i class='bx bxs-user icon'></i>
                                    <div class="card hidden">
                                        <ul class="dropdown-profile">
                                          <li><a class="text-profile" href="user-profile.php">Profile</li></a>
                                          <li><a class="text-profile" href="logout.php">Log Out</li></a>
                                        </ul>
                                </div>
                            </li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                </nav>
            </div>
        </header>
        <section class="content-produk">
            <div class="img-produk2">
                    <img src="../gambar_produk/<?php echo $produk['nama']?>/<?php echo $produk["gambar_produk"];?>" alt="1">    
            </div>
            <div class="produk">
                <h1 class="title-produk">
                    <?php echo $produk['nama']?>
                </h1>
                <div class="box-produk">
                    <div class="detail-produk">
                        <h2>
                            Kondisi : <?php echo $produk['kondisi']?>
                        </h2>
                        <h2 >
                            Waktu Tersisa :<a id="demo"></a>
                        </h2>
                        <a>
                        <h2>
                            Status : <?php echo $produk['status'];?>
                        </h2>
                    </div>
                    <div class="pricename">
                        <h2>
                        Harga : 
                        </h2>
                        <?php if ($produk['harga_terakhir'] == 0):?>
                        <p>Rp. <?php echo $produk['harga_awal']?></p>
                        <?php else: ?>
                            <p>Rp. <?php echo $produk['harga_terakhir']?></p>
                        <?php endif;?>
                    </div>
                    <?php if($produk['id_bidders'] == $idx):?>
                    <a class="warn"><h3><center>Anda Sudah Melelang Barang Ini</center></h3></a>
                    <?php else :?>
                    <form method="post">
                        <div class="price">
                            <div class="money">
                                <div class="currency">
                                    <a>
                                    Rp
                                    </a>
                                </div>
                            <input type="hidden" name="id"value="<?php echo $produk['id_bid']?>">
                            <input type="number" class="input-price" name="harga" required>
                            </div>
                            <button type="submit" class="btn-insprice" name="insprice">Lelang</button> 
                        </div>

                        <?php
                         if ($produk['harga_terakhir'] == 0){
                                if(isset($_POST['insprice'])) {
                                    if($_POST['harga'] < $produk['harga_awal']){
                                        echo "<div><h4><center> Harga harus diatas Rp".$produk['harga_awal']."</center></div>";
                                    }else{
                                        $price = $_POST['harga'];
                                        $id = $_POST['id'];
                                        $result = mysqli_query($conn,"UPDATE bid SET harga_terakhir = '$price' where id_bid = $id");
                                        $result = mysqli_query($conn,"UPDATE bid SET harga_terakhir = '$price' id_bidders = '$idx' where id_bid = $id");
                                            $result2 =mysqli_query($conn,"INSERT INTO history values('','$id','$idx','$price','proses')");
                                        if($result and $result2){
                                            echo"<script>
                                                    alert('Anda Berhasil Lelang');
                                                    document.location.href ='produk.php?id=$id';
                                                    </script>";
                                        }else{
                                            echo"<script>
                                            alert('Anda gagal Melelang');
                                            document.location.href ='produk.php?id=$id';
                                            </script>";
                                        }
                                    }      
                                }
                        }else{
                            if(isset($_POST['insprice'])) {
                                    if($_POST['harga'] < $produk['harga_terakhir']){
                                        echo "<div><h4><center> Harga harus diatas Rp".$produk['harga_terakhir']."</center></div>";
                                    }else{
                                            $price = $_POST['harga'];
                                            $id = $_POST['id'];
                                            $result = mysqli_query($conn,"UPDATE bid SET harga_terakhir = '$price',id_bidders = '$idx' where id_bid = $id");
                                            $result2 =mysqli_query($conn,"INSERT INTO history values('','$id','$idx','$price','proses')");
                                            if($result and $result2){
                                                echo"<script>
                                                        alert('Anda Berhasil Lelang');
                                                        document.location.href ='produk.php?id=$id;'
                                                        </script>";
                                            }else{
                                                echo"<script>
                                                alert('Anda gagal Melelang');
                                                document.location.href ='produk.php?id=$id';
                                                </script>";
                                            }
                                    }      
                                }
                            }
                        ?>
                            
                    </form>
                    <?php endif;?>
                </div>
                <div class="box-desc">
                    <h2>
                        Deksripsi Barang 
                    </h2>
                    <p>
                        <?php echo $produk['deskripsi']?>
                    </p>
                </div>
            </div>
           
        </section>
        <div class="box2">
            <div class="box-bid-section">
                <div class="text-bid">  
                 <h4>Aktivitas Penawaran</h4>
                </div>
                <div class="box-bid">
                    <div class="box-bid-title">
                        <h4>Pemenang</h4>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="col-1">
                                    <p>Nama</p>
                                </th>
                                <th class="col-2">
                                    <p>Penawaran</p>
                                </th>
                                <th class="col-3">
                                    <p>Status</p>
                                </th>
                            </tr>
                            <tbody>
                                <tr>
                                    <?php if($produk['id_bidders'] == 0 ){ ?>
                                    <td>
        
                                    <center><p>Tidak Ada Penawaran</p></center>
                                </td>
                                <?php }else{ ?>
                                    <?php $i = 1;foreach($users as $usr){?>
                                <td class="col-1">
                                    <p><?php echo $usr['name'] ?></p>
                                </td>
                                <td class="col-2">
                                <p><?php echo $usr['bid'] ?></p>
                                </td>
                                <td class="col-3">
                                    <p><?php echo $usr['status']?></p>
                                </td>
                                <?php $i++;}?>
                                <?php } ?>
                                </tr>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    <?php $timer = $produk['tanggal_berakhir'];?> 
var countDownDate = new Date("<?php echo $produk['tanggal_berakhir'] ?>").getTime();
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";


  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "Waktu Habis";
    document.getElementById("hide").style.display= 'block';
    document.getElementById("show").style.display= 'none';
  }
}, 1000);
</script>