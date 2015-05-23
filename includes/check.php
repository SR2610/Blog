<?php
session_start();
include("dbInfo.php");
$conn = mysqli_connect("localhost",DBUSERNAME,DBPASSWORD,DB);
$stored_password="Hahahaha, This is a fake password";

$username=$_POST['username'];
$password=$_POST['password'];
$query = mysqli_query($conn,"SELECT * FROM Users WHERE Username = '$username'");
     while($row = $query->fetch_assoc()) {
	  $stored_password = $row["Password"];
	 }

if(password_verify($password,$stored_password)){
$_SESSION["username"]=$username;
		header("location:../newPost.php");
	} else {
print "Login failed!";
}
?>
