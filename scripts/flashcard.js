$(document).ready(function(){
	$("#startQuizBtn").click(startQuiz);
	$("#explainBtn").click(explainQuestion);
	$("#nextQuestionBtn").click(nextBtnAction);

	$("#explanation").hide();

});

var m_questionNumber = 0;
var n_attemps = 0;

function startQuiz(){

	$("#startQuizBtn").hide();
	$("#quizContainer").show();

	getNextQuestion();

}

function shuffleArray(arr){
	for(var i = arr.length - 1; i > 0; i--){
		var swap = Math.floor(Math.random() * (i + 1));
		var temp = arr[i];
		arr[i] = arr[swap];
		arr[swap] = temp;
	}
}

function showChoices(arr){
	for(var i in arr){
		var radID = "rad_" + i;
		var input = $("<input>",{id : radID , class : "radButtons",  "type" : "radio", "name" : "user-answer" , "value" : arr[i]});
		var radLabel = $("<label>",{"for" : radID});
		radLabel.html(arr[i]);
		$("#answers").append(input);
		$("#answers").append(radLabel);
	}
}

function nextBtnAction(){

	var ans;

	if($("input[name=user-answer]:checked").length > 0){
		ans = $("input[name=user-answer]:checked").val();
	}else{
		ans = $("input[name=user-answer]").val().toLowerCase();
	}

	if(!ans){
		console.log("enter an answer");
	} else {
		$.ajax({
			type : "POST",
			url : "flashcard.php",
			data : {op : "check" , questionNumber : m_questionNumber , answer : ans},
			success : function(data){
				if(data === 'true'){
					getNextQuestion();
				}else{
					wrongAnswer();
				}
			}
		});
	}

}

function wrongAnswer(){
	console.log("sir Montes is not happy");
}

function getNextQuestion() {

	m_questionNumber++;

	$.ajax({
		type : "POST",
		url : "flashcard.php",
		data : {op : "next" ,questionNumber : m_questionNumber},
		success : function (data){
			var q = JSON.parse(data);
			console.log(q);
			if(q[0]){

				if(q[0].type == 'mc'){

					$("#question").html(q[0].question);
					var choices = [];
					choices[0] = q[0].answer;
					choices[1] = q[0].choice1;
					choices[2] = q[0].choice2;
					choices[3] = q[0].choice3;

					$("#explanation").html(q[0].description);

					$("#answers").html("");

					shuffleArray(choices);
					showChoices(choices);

				}else if(q[0].type == 'text'){

					$("#question").html(q[0].question);
					$("#explanation").html(q[0].description);

					var input = $("<input>",{id : "answerBox", "type" : "text", "name" : "user-answer"});
					$("#answers").html("");
					$("#answers").append(input);

				}


			}else{
				endFlahsCardQuiz();
			}
			

		},
		error : function(err){
			console.log(err);
		}
	});
}

function endFlahsCardQuiz(){
	console.log("ended");
}

function explainQuestion(){
	$("#explanation").show();
}