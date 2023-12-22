<?php
    session_name("user_session");
    session_start();
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>PHP Sessions Page 1</title></head>";
	print "<body><h1 align=center>PHP Sessions Page 1</h1>";
  	print "<hr/>\n";
    if (isset($_POST['username'])) {
        print "Cookie: ";
        print $_POST['username'];
        $_SESSION['username'] = $_POST['username'];
    }
    else if(isset($_SESSION['username'])) {
        print "Cookie: ";
        print $_SESSION['username'];
    }
    else {
        print "Cookie: None";
    }
    //More links
    print "<br>";
    print "<a href=\"/cgi-bin/PHP/php-sessions-2.php\">Session Page 2</a>";
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