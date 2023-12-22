<?php
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>General Request Echo</title></head>";
	print "<body><h1 align=center>General Request Echo</h1>";
  	print "<hr/>\n";
    $requestProtocol = $_SERVER['SERVER_PROTOCOL'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    print "Protocol: ";
    print ($requestProtocol);
    print "<br>";
    print "Method: ";
    print ($requestMethod);
    print "<br>";
    print "Message Body: <br>";
    $body = file_get_contents('php://input');
    print ($body);
?>