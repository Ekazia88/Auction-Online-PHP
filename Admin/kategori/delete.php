<?php
require '../../config.php';
session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}
$id =$_GET['id'];
$result =mysqli_query($conn, "DELETE FROM kategori Where id_kat =$id");
if($result){
    echo"<script>
        alert('Data  Berhasil Dihapus');
        document.location.href ='read.php';
        </script>";
  }else{
    echo"<script>
    alert('Data Gagal Dihapus');
    document.location.href ='read.php';
    </script>";
}
?>