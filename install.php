<html>
<head>
<title>Install Blog Backend</title>
</head>
<body>
	<?php
		if (empty($_GET["step"])||$_GET["step"]=="1"){
			$step = 1;
		} else {
			$step = $_GET["step"];
		}
	
		
		if ($_SERVER["REQUEST_METHOD"]=="POST"){
		switch($step){
			case 1:
				$db = $_POST["db"];
				$un = $_POST["username"];
				$pw = $_POST["password"];
				$conn = mysqli_connect("localhost",$un,$pw,$db);
				if (!$conn){
					$err = "Cannot connect!";
				} else {
					$config = fopen("includes/dbInfo.php","wb");
					if (!is_writable("includes/dbInfo.php")){
						$err = "Config not writable! Are permissions set?";
					} else {
						$string = "<?php\ndefine('DBUSERNAME','".$un."');\ndefine('DBPASSWORD','".$pw."');\ndefine('DB','".$db."');\n?>";
						fwrite($config,$string);
						fclose($config);
						mysqli_query($conn,"CREATE TABLE `$db`.`Posts` ( `ID` INT(11) NOT NULL AUTO_INCREMENT , `Title` VARCHAR(128) NOT NULL , `Content` LONGTEXT NOT NULL , `Author` VARCHAR(20) NOT NULL , `Date` DATE NOT NULL , PRIMARY KEY (`ID`) ) ENGINE = InnoDB;");
						
						mysqli_query($conn,"CREATE TABLE `$db`.`Users` ( `Username` VARCHAR(20) NOT NULL , `Password` VARCHAR(30) NOT NULL , PRIMARY KEY (`Username`) ) ENGINE = InnoDB;");
						header("Location:install.php?step=2");
					}

				}
				break;
			case 2:
				$username = $_POST["username"];
				$pw1 = $_POST["pw1"];
				$pw2 = $_POST["pw2"];
				if ($pw1 != $pw2){
					$err = "Passwords do not match!";
					break;
				}
				else {
					include("includes/dbInfo.php");
					$conn = mysqli_connect("localhost",DBUSERNAME,DBPASSWORD,DB);
					if (mysqli_query($conn,"INSERT INTO `".DB."`.`Users` (`Username`, `Password`) VALUES ('$username', '$pw1')")){
						header("Location:install.php?step=3");
					}
				}
		}
		}
	
		
		switch($step){
			case 1:
				$output = 
				"<form method='POST' action='install.php?step=1'>
				<fieldset>
					<label for='db'>Database Name:</label>
					<input type='text' name='db'/>
					<br>
					<label for='username'>Username:</label>
					<input type='text' name='username'/>
					<br>
					<label for ='password'>Password:</label>
					<input type='password' name='password'/>
					<br>
					<input type='submit' name='Connect'/>
					</fieldset>
				</form>";
				echo $output;
				echo $err;
				break;
			case 2:
				$output =
				"<form method='POST' action='install.php?step=2'>
				<fieldset>
					<label for='username'>Username:</label>
					<input type='text' name='username'/>
					<br>
					<label for='pw1'>Password:</label>
					<input type='password' name='pw1'/>
					<br>
					<label for ='pw2'>Retype Password: :</label>
					<input type='password' name='pw2'/>
					<br>
					<input type='submit' name='Create account'/>
					</fieldset>
				</form>";
				echo $output;
				echo $err;
				break;
			case 3:
				echo "Installation complete! For security reasons please delete this install file";
		}
		
		
	?>
</body>
</html>
