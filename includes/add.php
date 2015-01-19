<?php
	session_start();
	include("dbInfo.php");
	$conn = mysqli_connect("localhost",DBUSERNAME,DBPASSWORD,DB);
	
	$title=$_POST["title"];
	$content=$_POST["content"];
	$username=$_SESSION["username"];
	$date = getdate();
	$datef = $date['year']."-".$date['mon']."-".$date['mday'];
	
	$command="INSERT INTO `".DB."`.`Posts` (`ID`, `Title`, `Content`, `Author`, `Date`) VALUES (NULL, '$title', '$content', '$username', '$datef')";
	
	if(mysqli_query($conn,$command)){
	header("location:../index.php");
	}
?>