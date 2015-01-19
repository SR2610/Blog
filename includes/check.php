<?php
	session_start();
	include("dbInfo.php");
	$conn = mysqli_connect("localhost",DBUSERNAME,DBPASSWORD,DB);
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$query = mysqli_query($conn,"SELECT * FROM Users WHERE Username = '$username' AND Password = '$password'");
	
	if (mysqli_num_rows($query)==1){
		$_SESSION["username"]=$username;
		header("location:../newPost.php");
	} else {
		print "Login failed!";
	}
?>