<?php

	$url = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'webtechlec';

	$conn = mysqli_connect($url,$user,$pass,$db);


	if(isset($_POST['op'])){
		if($_POST['op'] == 'check'){
			check($_POST['questionNumber'],$_POST['answer']);
		}

		if($_POST['op'] == 'next'){
			serveNextQuestion();
		}
	}

	function check($qNumber,$ans){

		global $conn;

		$sql = "SELECT answer FROM questions WHERE id = $qNumber LIMIT 1";
		$res = $conn->query($sql);

		while($row = $res->fetch_array()){
			if($row['answer'] == $ans){
				echo 'true';
			}else{
				echo 'false';
			}
		}

	}

	function serveNextQuestion(){

		global $conn;

		if(isset($_POST['questionNumber'])){
		
			$questionNumber = $_POST['questionNumber'];

			$sql = "SELECT * FROM questions WHERE id = $questionNumber LIMIT 1";

			$res = $conn->query($sql);

			$rows = array();

			while($row = $res->fetch_array()){
				$rows[] = $row;
			}

			echo json_encode($rows);

		}
	}

?>