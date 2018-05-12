<?php

    session_start();

    if(!isset($_SESSION['user'])){
        header("Location: /login.php");
        die();
    }

?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../../styles/flashcards-style.css">
    <link rel="stylesheet" type="text/css" href="../../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../../styles/nav.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../styles/flashcards-style.css">
    <script src="../../scripts/jquery-3.2.1.min.js"></script>
    <script src="../../scripts/flashcard.js"></script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li>
                <div class="dropdown">
                    <div class="dropdown-button"><a href="../../html/finals.html">Server Side Scripting</a>
                        <div class="dropdown-content">
                            <a href="../../html/java.html">Java</a>
                            <a href="../../html/php.html">PHP</a>
                            <a>JavaScript</a>
                            <a>Active Server Pages</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <div class="dropdown-button">
                        <a href="../../html/flashcards/">Review</a>
                    </div>
                </div>
            </li>
            <li><a href="../../html/glossaryv2.html">Glossary</a></li>
            <li><a href="../../html/about.html">About</a></li>
        </ul>
    </nav>

    <div id="mini-hero-banner">
        <div id="particles-js"></div>

        <script type="text/javascript" src="../../scripts/particles.js"></script>
        <script type="text/javascript" src="../../scripts/particles-app.js"></script>
        <div class="wrapper">
            <h1>Review</h1>
        </div>
        
    </div>
    <div id="page-content">
        
        <div class="goBtnContainer">
            <?php
                if(isset($_GET['set'])){
                    $set = $_GET['set'];

                    require "../../includes/connectToDb.php";

                    $stmt = $conn->prepare("SELECT * FROM quiz where q_user = ? and q_set = ?");
                    $stmt->bind_param("sd",$_SESSION['user'],$set);
                    $stmt->execute();

                    $res = $stmt->get_result();

                    if($res->num_rows > 0){
                        $score = $res->fetch_assoc()['score'];
                        echo "<h2>You've already done this quiz! Your score was $score</h2>";
                    }else{
                        echo "<button id='startQuizBtn' data-set = $set >GO</button>";
                    }
                   
                }else{
                    header("Location: setselect.html");
                    die();
                }
                
            ?>
        </div>
        <div id="quizContainer" style="display: none;">
            <div id = "score-info">
                <span>Merrits : </span><span id="merrits"></span>
                <span>Total Score : </span><span id="score"></span>
            </div>
            <p id="question"></p>
            <form id="answers">

            </form>
            <div id="explanation">
            </div>
            <table id="btnTable">
                <tr>
                    <td>
                        <button id="nextQuestionBtn" class="quizButtons">NEXT</button>
                    </td>
                    <td>
                        <button id="explainBtn" class="quizButtons">EXPLAIN</button>
                    </td>
                </tr>
            </table>
        </div>
        <div id = "quiz-endcard" style="display:none">
            <h2>You made it!</h2>
            <div id = "end-score-info">
                <p>Final Score</p><p id="score"></p>
            </div>
            <form action="end.php" method="POST">
                <input type="hidden" name = "score" id = "endScore">
                <input type="hidden" name="set" id = "endSet">
                <input type="submit" value = "Save">
            </form>
        </div>
    </div>
    <footer>
        <p>WebLex 2018</p>
        <p>Saint Louis University - School of Information and Computer Sciences. Web Systems and Technology 2nd Semester S.Y. 2017-2018. 9331A - Group 3</p>
    </footer>
</body>

</html>