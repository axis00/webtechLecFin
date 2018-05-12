<?php

	require "../../includes/connectToDb.php";

	if(isset($_POST['op']) && isset($_POST['questionNumber']) && isset($_POST['set'])){
		if($_POST['op'] == 'check'){
			check($_POST['questionNumber'],$_POST['answer'],$_POST['set']);
		}

		if($_POST['op'] == 'next'){
			serveNextQuestion($_POST['set']);
		}
	}

	function check($qNumber,$ans,$set){

		global $conn;

		$sql = "SELECT answer FROM questions WHERE questionNumber = $qNumber AND q_set = $set LIMIT 1";
		$res = $conn->query($sql);
        
		while($row = $res->fetch_array()){
			if($row['answer'] == $ans){
				echo 'true';
			}else{
				echo 'false';
			}
		}

	}

	function serveNextQuestion($set){

		global $conn;

		if(isset($_POST['questionNumber'])){
		
			$questionNumber = $_POST['questionNumber'];

            $sql = "SELECT * FROM questions WHERE questionNumber = $questionNumber AND q_set = $set LIMIT 1";


			$res = $conn->query($sql);

			$rows = array();

			while($row = $res->fetch_array()){
				$rows[] = $row;
			}

			echo json_encode($rows);

		}
	}

?>