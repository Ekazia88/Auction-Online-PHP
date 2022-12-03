<?php
require '../config.php';
if(isset($_POST['daftar'])){
  $nama = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['mail'];
  $telp = $_POST['nophone'];
  $gambaruser = $_FILES['myFile']['name'];
  if(!empty($nama) || !empty($username) || !empty($password) || !empty($email)){
    $cek_email=mysqli_query($conn,"SELECT * from users where email ='$email' ");
    $cek_username=mysqli_query($conn,"SELECT * from users where username ='$username' ");
    $jml_email=mysqli_num_rows($cek_email);
    $jml_username =mysqli_num_rows($cek_username);
    if($jml_email>0){
      header("location:register.php?pesan=gagal1");
    }
    else if($jml_username>0){
        header("location:register.php?pesan=gagal2");
    }else{
      $password_encrypted = password_hash($password, PASSWORD_DEFAULT);
      $folder = mkdir("../gambar_user/$nama/");
      $target_dir = "../gambar_user/$nama/";
      $target_file = $target_dir . basename($_FILES["myFile"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $extensions_arr = array("jpg","jpeg","png","gif","webp");
  if( in_array($imageFileType,$extensions_arr) ){
    if(move_uploaded_file($_FILES['myFile']['tmp_name'],$target_dir.$gambaruser )){
      $sql = "INSERT INTO users values ('','$nama','$username','$password_encrypted','$email','user')";
      $result = mysqli_query($conn, $sql);
      $max1 = mysqli_query($conn,"SELECT * from users where username = '$username'");
      $mx = [];
    while($row = mysqli_fetch_assoc($max1)){
    $mx[] =$row;
    }
    $mx = $mx[0];
    $max = $mx['id_user'];
    $sql2 = "INSERT INTO bidder values('','$max','$nama','$gambaruser','$telp')";
     $result2 = mysqli_query($conn, $sql2); 
      if($result and $sql2){
          echo"<script>
                alert('Register anda berhasil!!');
                document.location.href ='login.php';
                </script>";
      }else{
          echo"<script>
          alert('Anda Gagal Register');
          document.location.href ='register.php';
          </script>";
      }
    }
  }
    }
}
  }
?>