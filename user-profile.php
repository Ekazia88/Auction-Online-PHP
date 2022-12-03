<?php
session_start();
if($_SESSION['level'] != "user"){
    echo "<script>alert('Login Dulu');
    document.location.href ='index.php?pesan=gagal';</script>";
}
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="./css/user-profile.css">
  <script src="./js/script.js"></script>
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
                        <form action="" method="post">
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
                        <button title="Search" value="" type="submit" name="cari"/>
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
                                          <li><a class="text-profile" href="profile.php">Profile</li></a>
                                          <li><a class="text-profile" href="logout.php">Log Out</li></a>
                                        </ul>
                                </div>
                            </li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#" >Login / Register</a></li>
                        </ul>
                </nav>
            </div>
        </header>
        <section class="content-user">
            <div class="wrapper-2">
                <div class="left">
                    <img src="/img/1617736991_112-1123171_ps4-png-picture-playstation-4-transparent-png.png" 
                    alt="user" width="100">
                    <h2>Alex William</h2>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>Information</h3>
                        <div class="info_data">
                             <div class="data">
                                <h4>Email</h4>
                                <p>alex@gmail.com</p>
                             </div>
                             <div class="data">
                               <h4>Phone</h4>
                                <p>0001-213-998761</p>
                          </div>
                        </div>
                    </div>
                  
                  <div class="projects">
                        <h3></h3>
                        <div class="projects_data">
                             <div class="data">
                                <h4>Username</h4>
                                <p>Lorem ipsum dolor sit amet.</p>
                             </div>
                             <div class="data">
                               <h4>Most Viewed</h4>
                                <p>dolor sit amet.</p>
                          </div>
                        </div>
                    </div>    
                  </div>
                </div>
            </div>
        </section>
    </body>
</html>