<?php
session_start();
include '../config.php';
if($_SESSION['level'] != "user"){
    echo "<script>alert('Login Dulu');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$id = $_SESSION['id_user'];
$result = mysqli_query($conn,"SELECT * FROM kategori");
  $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
  $kategori[] = $row;
}
$result2 = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = id_produk join kategori on produk.idcat = kategori.id_kat");
   $produk = [];
   while($row = mysqli_fetch_assoc($result2)){
   $produk[] = $row;
}
$sql = mysqli_query($conn,"SELECT * FROM bidder join users on bidder.id_user = users.id_user where id_bidder = '$id'");
$users = [];
while($row = mysqli_fetch_assoc($sql)){
$users[] = $row;
}
$users = $users[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/index.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> 
  <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../css/user-profile.css">
  <script src="../js/script.js"></script>
  <title>User Profile</title>
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
        <section class="content-user">
            <div class="wrapper-2">
                <div class="left">
                    <img src="../gambar_user/<?php echo $users['name'];?>/<?php echo $users['gambar'];?>" 
                    alt="user" width="100">
                    <h2><?php echo $users['name'] ?></h2>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>Information</h3>
                        <div class="info_data">
                             <div class="data">
                                <h4>Email</h4>
                                <p><?php echo $users['email']?></p>
                             </div>
                             <div class="data">
                               <h4>Phone</h4>
                                <p><?php echo $users['telp']?></p>
                          </div>
                        </div>
                    </div>
                  <div class="projects">
                        <h3></h3>
                        <div class="projects_data">
                             <div class="data">
                                <h4>Username</h4>
                                <p><?php echo $users['username']?></p>
                             </div>
                        </div>
                    </div>    
                  </div>
                </div>
            </div>
        </section>
    </body>
</html>