<!DOCTYPE>
<html>

<head>
    <title>WebLex: Web Systems and Technologies Lectures</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/nav.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="scripts/jquery-3.2.1.min.js"></script>
    <script src="scripts/parallax.js"></script>
    <script>
        $().ready(function() {
            var scene = $('#hero-banner .wrapper').get(0);
            var parallaxInstance = new Parallax(scene);
        });
    </script>
    <meta charset="utf-8" />
</head>

<body>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
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

            <?php

                session_start();

                if(isset($_SESSION['user'])){
                    echo '<li style = "color : rgb(178, 80, 44)" ><a href="./logout.php">Logout</a></li>';
                }else{
                    echo '<li><a href="./login.php">Login</a></li>';
                    echo  '<li><a href="./register.php">Register</a></li>';
                }

            ?>
        </ul>
    </nav>

    <div id="hero-banner">

        <div id="particles-js"></div>

        <script type="text/javascript" src="scripts/particles.js"></script>
        <script type="text/javascript" src="scripts/particles-app.js"></script>

        <div class="wrapper">

            <div id="heading" data-depth="0.2">
                <h1>WebLex</h1>
            </div>
            <img id="ds" src="assets/hero_banner/ds.png" data-depth=".05" />
        </div>
    </div>

    <div class="index-content">
        <h2>Welcome to WebLex, a collection of informative lectures about the web.</h2>
        <ul>
            <li>Get ready to learn more about the web and its fundamentals by accessing the "<a href="./html/topics.html">Courses</a>" option in the navigation bar.</li>
            <li>Test your knowledge and understanding of the different topics discussed by accessing the "<a href="./html/flashcards/index.php">Review"</a> option in the navigation bar.</li>
            <li>Find important and relevant terms from the "<a href="./html/glossary.html">Glossary</a>" section of the navigation bar.</li>
            <li>Learn more about the website from the "<a href="./html/about.html">About</a>" section of the navigation bar.</li>
        </ul>
    </div>

    <footer>
        <p>WebLex 2018</p>
        <p>Saint Louis University - School of Information and Computer Sciences. Web Systems and Technology 2nd Semester S.Y. 2017-2018. 9331A - Group 3</p>
    </footer>
</body>

</html>