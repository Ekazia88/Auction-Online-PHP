<?php
include '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}

if (isset($_POST['search'])) {
    $search=trim($_POST['search']);
    $sql= "SELECT DISTINCT bid.id_bid, produk.nama, history.status_lelang FROM history
    JOIN bid on history.idbid = bid.id_bid
    join produk on bid.id_products = produk.id_produk where status_lelang = 'proses' and nama like '%".$search."%' order by id_history asc";
    $result = mysqli_query($conn,$sql);
    $history = [];
  while($row = mysqli_fetch_assoc($result)){
    $history[] =$row;
  }
  }else {

    $sql = " SELECT DISTINCT bid.id_bid, produk.nama, history.status_lelang FROM history
            JOIN bid on history.idbid = bid.id_bid
            join produk on bid.id_products = produk.id_produk where status_lelang = 'proses'";
    $result = mysqli_query($conn,$sql);
    $history =[];   
    while($row = mysqli_fetch_assoc($result)){
    $history[] = $row;
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
    <link rel="stylesheet" href="./../../css/fontawesome-free-6.2.0-web/css/all.css">
    <link rel="stylesheet" href="./../css/fontawesome-free-6.2.0-web/css/all.min.css">
    
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
        <div class="text">Bid</div>
        <div class="content">
            <div class="table-responsive">
                <div class="record-header">
                    <div class="search-sec">
                        <form action="" method="post">
                            <input type="search" name="search" placeholder="Search" class="search-record">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>
                </div>
                <div class="record">
                    <div class="table-wrap"></div>
                    <table>
                        <thead class="header-table">
                        <tr>
                           <th class="col1-1">#</th>
                           <th class="col2-1">Produk</th> 
                           <th class="col3-1">status</th>
                           <th class="col4-1">Liat Pelelang</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                 <?php $i=1; foreach($history as $his):?>
                                    <?php $i;?>

                                <td class="col1-1"><?php echo $his['id_bid'];?></td>
                                <td class="col2-1"><?php echo $his['nama'];?></td>
                                <td class="col3-1"><?php echo $his['status_lelang'];?></td>
                                <td class="col3-1">
                                    <a class="icon"href="produk.php?id=<?php echo $his['id_bid']?>">
                                    <i class="fa-sharp fa-solid fa-users icon"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                            <?php $i++; endforeach;?>
                    </table>
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
