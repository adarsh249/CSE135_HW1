<?php
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>Environment Variables</title></head>";
	print "<body><h1 align=center>Environment Variables</h1>";
  	print "<hr/>\n";
    foreach ($_SERVER as $key=>$value){
        print "<b>$key</b>: $value<br>";
    }
?>