<?php
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>POST Message Body</title></head>";
	print "<body><h1 align=center>POST Message Body</h1>";
  	print "<hr/>\n";
    $body = file_get_contents('php://input');
    print "Message Body: <br>";
    print ($body);
?>