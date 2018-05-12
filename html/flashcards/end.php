<?php

	session_start();

	if(!isset($_SESSION['user'])){
        header("Location: /login.php");
        die();
    }

    if(isset($_SESSION['user']) && isset($_POST['score']) && isset($_POST['set'])){

    	$username = $_SESSION['user'];
    	$score = $_POST['score'];
    	$set = $_POST['set'];

    	require "../../includes/connectToDb.php";

    	$stmt = $conn->prepare("INSERT INTO quiz (q_user, score, q_set) VALUES (?, ?, ?)");
		$stmt->bind_param("sdd",$username,$score,$set);

		if($stmt->execute()){
			header("Location: /");
			die();
		}else{
			echo $stmt->error;
		}

    }

?>