<?php
require '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM kategori WHERE id_kat = $id");
$kat =[];

while($row = mysqli_fetch_assoc($result)){
  $kat[] = $row;
}

$kat = $kat[0];

if(isset($_POST['update'])){
  $id =$_POST['id'];
  $nama = $_POST['nama'];

  $sql = "UPDATE kategori SET name_kat = '$nama' where id_kat = $id";
  $result = mysqli_query($conn,$sql);

  if($result){
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/style.css">
    <link rel="stylesheet" href="./../css/crud.css">
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.2.0-web/css/all.min.css">
</head>
<body>
<?php autoupdate();?>
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
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="read.php">
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
                            <span class="text nav-text">Bidding</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../bid/read.php">
                            <i class='bx bx-book'></i>
                            <span class="text nav-text">Bid Status</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="../../Auth/logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>          
            </div>
        </div>
    </nav>
    <section class="main">
        <div class="text">Kategori Management / Edit </div>
        <div class="content">
            <h1>Update Data</h1>
            <form action="" method="post">
                <div class="container">
                    <input type="hidden" name="id" value="<?php echo $kat['id_kat']?>">          
                  <label for="name"><b>Kategori</b></label>
                  <input type="text" placeholder="Masukkan Nama" name="nama" value="<?php echo $kat['name_kat']?>"required>
                  <hr>      
                  <button type="submit"  name ="update" class="registerbtn">add</button>
                </div>
              </form>
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
