<?php
include '../config.php';
session_start();

$result = mysqli_query($conn,"SELECT * FROM Kategori");
  $kategori = [];
  while($row = mysqli_fetch_assoc($result)){
  $kategori[] = $row;
   }
?>
<html>
<head>
<title>LELO - Lelang online </title>  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/index.css">
<link rel="stylesheet" href="../css/register.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">   
<link rel="stylesheet" type="text/css" href="./css/lightslider.css">

</head>  
  <body>
    <div class="wrapper">
        <header>
            <div class="container">   
                <div class="logo">
                    <a href="../index.php">Lelo</a>
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
                            <li><a href="register.php">Contact</a></li>
                            <li><a href="login.php" >Login / Register</a></li>
                        </ul>
                </nav>
            </div>
    </header>
    <section class="register-section">
        <div class="register-container">
            <form action="register_valid.php" method="post" class="form-body" enctype="multipart/form-data">
                <div>
                    <div>
                        <label class="form-label" for="name">Nama</label>
                        <input class="input-text" type="text" name="name" id="name" placeholder="Masukkan Nama" />
                    </div>
                    <div>
                        <label class="form-label" for="last-name">Username</label>
                        <input class="input-text" type="text" name="username" id="last-name" placeholder="Masukkan username" />
                    </div>

                    <?php 
                    if(isset($_GET['pesan'])){
                                if($_GET['pesan']=="gagal1"){
                                    echo "<div class='alert' style='color:red;'><a>Username sudah dipakai!!</a></div>";
                                }
                            }
                        ?>
                    <div>
                        <label class="form-label" for="mail">Email</label>
                        <input class="input-text" type="email" name="mail" id="mail" placeholder="name@email.com" />
                    </div>
                </div>
                <?php
                if(isset($_GET['pesan'])){
                                if($_GET['pesan']=="gagal2"){
                                    echo "<div class='alert' style='color:red;'><a>Email sudah dipakai!!</a></div>";
                                }
                            }
                ?>
                <div>
                    <div>
                        <label class="form-label" for="mail">No telp</label>
                        <input class="input-text" type="text" name="nophone" id="nophone" placeholder="0888888" />
                    </div>
                <div>
                    <div>
                        <label class="form-label" for="password">Password
                            <span class="subtitle"></span></label>
                        <input class="input-text" type="password" name="password" id="password" placeholder="********" />
                    </div>
                    <label class="form-label"for="gambar"><b>Gambar</b></label>
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Klik / taro Disini Untuk Masukkan Gambar</span>
                            <input type="file" name="myFile" class="drop-zone__input">
                        </div>
                    <div class="form-footer">
                        <button type="submit" class="form-submit" value="create-account" name="daftar">
                            Buat Akun
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    </div>
  </body>
  <script type="text/javascript" src="./../js/script.js"></script>
  </html>