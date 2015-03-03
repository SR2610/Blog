<?php
	session_start();
	include("dbInfo.php");
	$conn = mysqli_connect("localhost",DBUSERNAME,DBPASSWORD,DB);
	

$html=$_POST["content"];
$tidy = new Tidy();
$clean = $tidy->repairString($html, array(
    "output-xml" => true,
    "input-xml" => true));


	$title=$_POST["title"];
	$content=$clean;
	$username=$_SESSION["username"];
	$date = getdate();
	$datef = $date['year']."-".$date['mon']."-".$date['mday'];
	
	$command="INSERT INTO `".DB."`.`Posts` (`ID`, `Title`, `Content`, `Author`, `Date`) VALUES (NULL, '$title', '$content', '$username', '$datef')";
		
	if(mysqli_query($conn,$command)){
	header("location:../index.php");
	}
?>
