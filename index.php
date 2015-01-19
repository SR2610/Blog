<html>
<head>
<title>Blog</title>
</head>

<body>
	<?php
		session_start();
		include("includes/dbInfo.php");
		$conn = mysqli_connect("localhost",DBUSERNAME,DBPASSWORD,DB);
		
		$query = mysqli_query($conn,"SELECT * FROM Posts");
		$total=mysqli_num_rows($query);
		
		
		if (empty($_GET["start"])){
			$start = $total;
			$end = $start-4;
			$back=false;
		} else {
			$start = $_GET["start"];
			$end = $start-4;
			if ($start+5>$total){
				$back=false;
			} else{
				$back=true;
			}
		}
		
		$articles = mysqli_query($conn,"SELECT * FROM Posts WHERE ID <= '$start' AND ID >= '$end' ORDER BY `ID` DESC");
		
		for ($i = 1; $i<= mysqli_num_rows($articles); $i++){
			$row = mysqli_fetch_assoc($articles);
			echo "<h1>".$row["Title"]."</h1>"; //Title of article
			echo "<h3>By: ".$row["Author"]."</h3>"; //Author of article
			echo "<p>".$row["Content"]."</p>"; //Main content of article
			echo "<P>".$row["Date"]."</p>"; //Date article was created
		}
		

		if ($back==true){
			echo "<a href='index.php?start=".($start+5) ."'>Previous Page</a>";
		}
		
		if ($end>0){
			echo '<a href="index.php?start='.($start-5) .'">Next Page</a>';
		}
	?>
</body>
</html>