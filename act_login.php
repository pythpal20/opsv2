<?php
session_start();
include 'konn.php';
 
$username = $_POST['username'];
$password = md5($_POST['password']);
 
$login = mysqli_query($con,"select * from user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
	if($data['level']=="admin"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		header("location:admin/admin.php");
 
	}else if($data['level']=="user"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";
		header("location:index.php");
		
	}else if($data['level']=="basecamp"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "basecamp";
		header("location:basecamp/basecamp.php");
	}else{
 
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}
 
?>