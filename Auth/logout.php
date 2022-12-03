<?php 
session_start();
if($_SESSION['level'] != "user" and $_SESSION['level'] != "admin"  ){
    echo "<script>alert('Anda harus login!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
session_destroy();
echo  "<script>alert('Anda Berhasil Logout!!')</script>";
header("location: ../index.php");
?>
















