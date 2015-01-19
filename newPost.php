<?php
	session_start();
	$username=$_SESSION["username"];
	if (empty($username)){
		header("location:login.php");
	} else { ?>

<html>
<head>
<title>Add new post</title>
</head>

<body>
<form method="POST" action="includes/add.php">
<fieldset>
	<legend>Add New Post</legend>
	<label for="title">Title:</label>
	<input name="title"/>
	<br><br>
	<label for="content">Body:</label>
	<br>
	<textarea name="content" cols="100" rows="20"></textarea>
	<br><br>
	<input type="submit" name="Post"/>
	</fieldset>
</form>
</body>
</html>
<?php } ?>