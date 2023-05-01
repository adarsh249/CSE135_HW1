<?php
    session_name("user_session");
    session_start();
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>Destroy PHP Session</title></head>";
	print "<body><h1 align=center>Destroy PHP Sessions</h1>";
  	print "<hr/>\n";
    $_SESSION = array(); //unsetting session vars
    session_destroy();
    print "<a href=\"/cgi-bin/PHP/php-sessions-1.php\">Back to Page 1</a><br>";
    print "<a href=\"/cgi-bin/PHP/php-sessions-2.php\">Back to Page 2</a><br>";
    print "<a href=\"/cgi-bin/PHP/php-state-demo.php\">PHP CGI Form</a><br>";
?>