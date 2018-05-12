<?php

	session_start();

	$homeUrl = "webtechlec.org";

	if(isset($_SESSION['user'])){
		header('Location: ' . $_SERVER['HTTP_REFERER']);
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
            function validate(field) {
                if (field.value != document.getElementById("password").value) {
                    field.setCustomValidity("Passwords Dont Match");
                } else {
                    field.setCustomValidity("");
                }
            }

        </script>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <link rel="stylesheet" type="text/css" href="../styles/nav.css">
        <link rel="stylesheet" type="text/css" href="/styles/login.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <title>Register</title>
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="./index.html">Home</a></li>
                <li>
                    <div class="dropdown">
                        <div class="dropdown-button"><a href="./html/finals.html">Server Side Scripting</a>
                            <div class="dropdown-content">
                                <a href="./html/java.html">Java</a>
                                <a href="./html/php.html">PHP</a>
                                <a href="./html/javascript.html">JavaScript</a>
                                <a href="./html/websecurity.html">Web Security</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <div class="dropdown-button">
                            <a href="./html/flashcards/index.php">Review</a>
                        </div>
                    </div>
                </li>
                <li><a href="./html/glossaryv2.html">Glossary</a></li>
                <li><a href="./html/about.html">About</a></li>
                <li><a href="./login.php">Login</a></li>
                <li><a href="./register.php">Register</a></li>
            </ul>
        </nav>
        <div id="mini-hero-banner">
            <div id="particles-js"></div>
            <script type="text/javascript" src="../scripts/particles.js"></script>
            <script type="text/javascript" src="../scripts/particles-app.js"></script>
            <div class="wrapper">
                <h1>Register</h1>
            </div>
        </div>
        <div id="login-container">
            <form method="POST" action="register.php">
                <p>Username</p>
                <input type="text" name="username" required="required">
                <br><p>Email</p><input type="email" name="email" required="required">
                <br><p>Password</p><input id="password" type="password" name="password" required="required">
                <br><p>Confirm Password</p><input type="password" name="passwordConf" required="required" oninput="validate(this)">
                <br><input type="submit" value="REGISTER">
            </form>
        </div>
    </body>

    </html>
