<?php
include '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * from history join bid on history.idbid = bid.id_bid
         join produk on bid.id_products = produk.id_produk
         join bidder on history.idbidder = bidder.id_bidder 
         join users on bidder.id_user = users.id_user where idbid = $id");
$his =[];
while($row = mysqli_fetch_assoc($result)){
  $his[] = $row;
}
if(isset($_POST['win'])){
    $idhis =$_POST['idhis'];
    $sql = "UPDATE history SET status_lelang = 'pemenang' where id_history = $idhis";
    $sql2 ="UPDATE history SET status_lelang = 'kalah' where idbid = $id";
    $result = mysqli_query($conn,$sql);
    $result2 = mysqli_query($conn, $sql2);

  if($result){
    $result2;
    echo"<script>
        alert('Data User Berhasil Diubah');
        document.location.href ='read.php';
        </script>";
  }else{
    echo"<script>
    alert('Data User Gagal Diubah');
    document.location.href ='edit.php?id={$id}';
    </script>";
  }
}
if(isset($_POST['win'])){

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
            <i class='bx bx-chevron-right toggle'>
            </i>
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
        <div class="text">User Management</div>
        <div class="content">
            <div class="table-responsive">
                <div class="record-header">
                    <div class="search-sec">
                        <input type="search" name="search" placeholder="Search" class="search-record">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="record">
                    <div class="table-wrap"></div>
                    <table>
                        <thead class="header-table">
                        <tr>
                           <th class="col1-1">#</th>
                           <th class="col2-1">Nama</th> 
                           <th class="col3-1">bid</th>
                           <th class="col4-1">Email</th>
                           <th class="col5-1">Pilih Pemenang</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            <tr>
                            <?php $i =1; foreach($his as $hi): ?>
                                <?php $i;?>
                                <form action="" method="post">
                                    <input type="hidden" name="idhis" value="<?php echo $hi['id_history']?>">
                                    <td class="col1-1"><?php echo $hi['id_history']?></td>
                                    <td class="col2-1"><?php echo $hi['name']?></td>
                                    <td class="col3-1"><?php echo $hi['bid']?></td>
                                    <td class="col4-1"><?php echo $hi['email']?></td>
                                    <?php if($hi["status_lelang"] != "pemenang"):?>
                                    <td class="col5-1">
                                        <input type="submit" name = "win" value="Pilih Sebagai Pemenang" class ="btn">
                                        </td>
                                    <?php else:?>
                                        <td class="col5-1"><?php echo $hi['status_lelang'];?>
                                        </td>
                                    <?php endif?>
                                </form>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
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
