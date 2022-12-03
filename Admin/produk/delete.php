<?php
require '../../config.php';

session_start();
if($_SESSION['level'] != "admin"){
    echo "<script>alert('Anda Bukan Admin!!!');
    document.location.href ='../index.php?pesan=gagal';</script>";
}

$id =$_GET['id'];
$sql = mysqli_query($conn,"SELECT * FROM produk where id_produk = $id");
$produk = [];
while($row = mysqli_fetch_assoc($sql)){
  $produk[] =$row;
  
}
$result =mysqli_query($conn, "DELETE FROM produk Where id_produk =$id");
$test ="";
foreach ($produk as $prk){
$test =$prk['nama'];

}
echo $test;
$dir = '../../gambar_produk/'.$test.'/';
function rrmdir($dir) { 
    foreach(glob($dir . '/*') as $file) { 
      if(is_dir($file)) rrmdir($file); else unlink($file); 
    } rmdir($dir); 
  }
if($result){
    rrmdir($dir);
    echo"<script>
        alert('Data User Berhasil Dihapus');
        document.location.href ='read.php';
        </script>";
  }else{
    echo"<script>
    alert('Data User Gagal Dihapus');
    document.location.href ='read.php';
    </script>";
}
?>