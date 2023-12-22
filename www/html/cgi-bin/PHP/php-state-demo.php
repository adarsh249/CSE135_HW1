
<?php
    print "<html><head><title>State Demo</title></head>";
	print "<body><h1 align=center>Session Test</h1>";
  	print "<hr/>\n";
    print "<label>PHP</label>";
    print "<form action=\"/cgi-bin/PHP/php-sessions-1.php\" method=\"Post\" id=\"form\">";
    print "<label>What is your name?  <input type =\"text\" name =\"username\" autocomplete=\"off\"></label>";
    print "<br>";
    print "<input type=\"submit\" value=\"Test Sessioning\">";
    print "</form>";
    print "<a href=\"/\" style=\"display:inline-block;margin-top:20px;\">Home</a>";
    print "</body>";
    print "</html>";
?>