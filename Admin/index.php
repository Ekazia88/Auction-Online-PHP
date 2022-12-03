<?php
include './../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$sql1 = mysqli_query($conn,'SELECT * from bidder');
$sql2 = mysqli_query($conn,'SELECT * from kategori');
$sql3 = mysqli_query($conn,'SELECT * from produk');
$sql4 = mysqli_query($conn,'SELECT * from bid');

$user = mysqli_num_rows($sql1);
$kategori = mysqli_num_rows($sql2);
$produk = mysqli_num_rows($sql3);
$bid = mysqli_num_rows($sql4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <!-- Font Icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/fontawesome.css">
    
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="img/admin-profile.png" alt="">
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
                        <a href="index.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./user/read.php">
                            <i class='bx bxs-user-rectangle icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./kategori/read.php">
                            <i class='bx bxs-category icon' ></i>
                            <span class="text nav-text">Category</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./produk/read.php">
                            <i class='bx bxs-cart icon'></i>
                            <span class="text nav-text">Product</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./bid/read.php">
                            <i class='bx bxs-briefcase-alt-2 icon'></i>
                            <span class="text nav-text">bidding</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./bid/read.php">
                        <i class='bx bx-book icon'></i>
                        <span class="text nav-text">Bid Status</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="../Auth/logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                
            </div>
        </div>

    </nav>
    <section class="main">
        <div class="text">Home</div>
        <div class="content">
        <div class="page-content">
            
            <div class="wrapper">

                <div class="card">
                    <div class="card-head">
                        <h2><?php echo $user?></h2>
                        <div class="icon-2">
                        <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div class="card-progress">
                        <h3>User</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h2><?php echo $kategori ?></h2>
                        <div class="icon-2">
                        <i class='bx bx-list-ul'></i>
                        </div>
                    </div>
                    <div class="card-progress">
                        <h3>kategori</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h2><?php echo $produk?></h2>
                        <div class="icon-2">
                        <i class='bx bxs-box' ></i>
                        </div>
                    </div>
                    <div class="card-progress">
                        <h3>Produk</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h2><?php echo $bid?></h2>
                        <div class="icon-2">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                    </div>
                    <div class="card-progress">
                        <h3>Terlelang</h3>
                    </div>
                </div>

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
