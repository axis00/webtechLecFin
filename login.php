<?php
	session_start();

	if(isset($_SESSION['user'])){
		header("Location: /");
		die();
	}

	if(isset($_POST['username']) && isset($_POST['password'])){
		$user = $_POST['username'];
		$password = $_POST['password'];
		$hashedPassword = "";

		require "includes/connectToDb.php";

		$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
		$stmt->bind_param("s",$user);
		$stmt->execute();

		$res = $stmt->get_result();
		
		if($res->num_rows === 0) exit("no user found");

		$hashedPassword = $res->fetch_assoc()['password'];

		if(password_verify($password,$hashedPassword)){
			$_SESSION['user'] = $user;
			header("Location: /");
			die();
		}

		$stmt->close();

		die();


	}

?>

<!DOCTYPE html>
<html>
	<body>
		<form action="login.php" method="POST">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" value="login">
		</form>
	</body>
</html>