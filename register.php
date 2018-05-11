<?php

	session_start();

	$homeUrl = "webtechlec.org";

	if(isset($_SESSION['user'])){
		header("Location: /");
		die();
	}

	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){

		require "includes/connectToDb.php";

		$username = $_POST['username'];
		$pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
		$email = $_POST['email'];

		$stmt = $conn->prepare("INSERT INTO users(username,password,email) VALUES(?,?,?)");
		$stmt->bind_param("sss",$username,$pass,$email);

		if($stmt->execute()){
			$_SESSION['user'] = $username;
			header("Location: /");
		}else{
			echo $stmt->error;
		}

		die();

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<script>

			function validate(field){
				if(field.value != document.getElementById("password").value){
					field.setCustomValidity("Passwords Dont Match");
				}else{
					field.setCustomValidity("");
				}
			}
			
		</script>
	</head>
	<body>
		<form method="POST" action="register.php">
			<input type = "text" name = "username" placeholder="Username" required = "required">
			<input type = "email" name = "email" placeholder="Email" required = "required">
			<input id = "password" type="password" name = "password" placeholder="Password" required = "required">
			<input type="password" name = "passwordConf" placeholder="Confirm Password" required = "required" oninput="validate(this)">
			<input type="submit" value="register">
		</form>
	</body>
</html>