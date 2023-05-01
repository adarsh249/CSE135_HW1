<?php
    session_name("user_session");
    session_start();
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>PHP Sessions Page 2</title></head>";
	print "<body><h1 align=center>PHP Sessions Page 2</h1>";
  	print "<hr/>\n";
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    else {
        $username = "None";
    }
    print "Cookie: ";
    print ($username);
    print "<br>";
    //More links
    print "<a href=\"/cgi-bin/PHP/php-sessions-1.php\">Session Page 1</a>";
    print "<br>";
    print "<a href=\"/cgi-bin/PHP/php-state-demo.php\">PHP CGI Form</a>";
    print "<br><br>";

    // Destroy Cookie button
    print "<form action=\"/cgi-bin/PHP/php-destroy-session.php\" method=\"get\">";
    print "<button type=\"submit\">Destroy Session</button>";
    print "</form>";

    print "</body>";
    print "</html>";

?>