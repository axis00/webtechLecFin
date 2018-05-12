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

    	$stmt = $conn->prepare("SELECT idquiz FROM quiz WHERE q_user = ? AND q_set = ?");
		$stmt->bind_param("sd",$username,$set);
		$stmt->execute();

		$res = $stmt->get_result();
		if($res->num_rows > 0) {
			header("Location: /");
			$stmt->close();
			die();
		}

		$stmt->close();


    	$stmt = $conn->prepare("INSERT INTO quiz (q_user, score, q_set) VALUES (?, ?, ?)");
		$stmt->bind_param("sdd",$username,$score,$set);

		if($stmt->execute()){
			header("Location: /");
			$stmt->close();
			die();
		}else{
			echo $stmt->error;
		}

    }

?>