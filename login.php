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

    <head>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <link rel="stylesheet" type="text/css" href="../styles/nav.css">
        <link rel="stylesheet" type="text/css" href="/styles/login.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <script src="../scripts/jquery-3.2.1.min.js"></script>
        <title>Login</title>
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
                <h1>Login</h1>
            </div>
        </div>
        <div id="login-container">
            <form action="login.php" method="POST">
                <p>Username</p>
                <input type="text" name="username">
                <br>
                <p>Password</p>
                <input type="password" name="password">
                <br><input type="submit" value="LOGIN">
            </form>
        </div>
    </body>

    </html>
