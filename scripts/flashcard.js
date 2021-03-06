$(document).ready(function(){
	$("#startQuizBtn").click(startQuiz);
	$("#explainBtn").click(explainQuestion);
	$("#nextQuestionBtn").click(nextBtnAction);

	$("#explanation").hide();

	$('#score-info #merrits').html(merrits);
    $('#score-info #score').html(n_score);

});

var m_questionNumber = 0;
var n_attemps = 0;
var merrits = 3;
var n_score = 0;
var correctAnswer;
var q_set = 0;

function startQuiz(){

    q_set = $("#startQuizBtn").attr('data-set');
    
	$("#startQuizBtn").hide();
	$(".taken").hide();
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
	$("#explanation").hide();

	if($("input[type=text]").val()){
		ans = $("input[type=text]").val().toLowerCase();
	}else{
		ans = $("input[name=user-answer]:checked").val();
	}

    console.log(ans);
    
	if(!ans){
		console.log("enter an answer");
	} else {
		$.ajax({
			type : "POST",
			url : "flashcard.php",
			data : {op : "check" , questionNumber : m_questionNumber , answer : ans, set : q_set},
			success : function(data){
                console.log(data);
				if(data === 'true'){
					handleCorrectAnswer();
				}else{
					handleWrongAnswer();
				}
			}
		});
	}

}

function handleCorrectAnswer(){
	n_attemps = 0;
    n_score += merrits;
    merrits = 3;
	getNextQuestion();
    $('#score-info #merrits').html(merrits);
    $('#score-info #score').html(n_score);
}

function handleWrongAnswer(){
    if(merrits) merrits--;
    $('#score-info #merrits').html(merrits);
}

function getNextQuestion() {

	m_questionNumber++;

	$.ajax({
		type : "POST",
		url : "flashcard.php",
		data : {op : "next" ,questionNumber : m_questionNumber, set : q_set},
		success : function (data){
            console.log(data);
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

					correctAnswer = q[0].answer;

					$("#explanation").html(q[0].description);

					$("#answers").html("");

					shuffleArray(choices);
					showChoices(choices);

				}else if(q[0].type == 'text'){

					$("#question").html(q[0].question);
					$("#explanation").html(q[0].description);

					correctAnswer = q[0].answer;

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
    $("#quizContainer").hide();
    $("#quiz-endcard").show();
    $("#end-score-info #score").html(n_score);

    $("#endScore").attr('value',n_score);
    $("#endSet").attr('value',q_set);

}

function explainQuestion(){
	$("#explanation").show();
}