<?php
include '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
if (isset($_POST['search'])) {
    $search=trim($_POST['search']);
    $sql="select * from users where name like '%".$search."%' or username like '%".$search."%' or email like '%".$search."%' order by id_user asc";
    $result = mysqli_query($conn,$sql);
    $user = [];
  while($row = mysqli_fetch_assoc($result)){
    $user[] =$row;
  
  }
  }else {
  $result = mysqli_query($conn,"SELECT * FROM users");
  $user = [];
  while($row = mysqli_fetch_assoc($result)){
    $user[] =$row;
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
                        <a href="user.php">
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
                           <th class="col1">#</th>
                           <th class="col2">Name</th>
                           <th class="col3">Username</th>
                           <th class="col4">Password</th>
                           <th class="col7">Email</th>
                           <th class="col6">Level</th> 
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $i = 1; foreach($user as $usr) :?>
                                <td class="col1"><?php echo '#',$usr['id_user'];?></td>
                                <td class="col2"><?php echo $usr["name"];?></td>
                                <td class="col3"><?php echo $usr["username"];?></td>
                                <td class="col4"><?php echo $usr["password"];?></td>
                                <td class="col5"><?php echo $usr["email"];?></td>
                                <td class="col6"><?php echo $usr["level"];?></td>
                            </tr>
                            <?php $i++; endforeach;?>
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
