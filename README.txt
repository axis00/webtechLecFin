Instructions:

Host the website using a PHP enabled server together with MySql or use a server package like WAMP.

Use MySql for your database and create a new schema named 'webtechlec' and import the webtechlec.slq file into that database

Change the url,user and password variable in the */includes/connectToDb.php* file to the appropreriate values(i.e. If you're running your database server on your local machine set $url = 'localhost', if you're using the root user set $user = 'root' and if your password to root is 'password' then set $pass = 'password' )