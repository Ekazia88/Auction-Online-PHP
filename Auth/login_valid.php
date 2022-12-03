<?php 

session_start();

include '../config.php';
 
$useremail =$_POST['user-email'];

$password = $_POST['pass'];

$login = mysqli_query($conn,"SELECT * from users where email='$useremail' or username ='$useremail'");
$cek = mysqli_num_rows($login);
 
if($cek > 0){
	$data = mysqli_fetch_assoc($login);
	$idx = $data['id_user'];
	$bidder = mysqli_query($conn,"SELECT * from bidder where id_user = '$idx' ");
	$id = mysqli_fetch_assoc($bidder);
	if(password_verify($password, $data['password'])) {
		if($data['level']=="admin"){	
			$_SESSION['email'] = $useremail;
			$_SESSION['username'] = $username;
			$_SESSION['level'] = "admin";
			header("location:../Admin/index.php");
		}else if($data['level']=="user"){
			$_SESSION['email'] = $useremail;
			$_SESSION['level'] = "user";
			$_SESSION['id_user'] = $id['id_bidder'];
   			header("Location: ../user/index.php");
		}
	}else{
		header("location:login.php?pesan=wrongpas");
	}	
}else{
	header("location:login.php?pesan=gagal2");
} 
?>