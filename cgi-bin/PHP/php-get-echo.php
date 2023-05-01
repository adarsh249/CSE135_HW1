<?php
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>GET query string</title></head>";
	print "<body><h1 align=center>GET query string</h1>";
  	print "<hr/>\n";
    if(!empty($_SERVER['QUERY_STRING'])){
        print "Raw query string: " . $_SERVER['QUERY_STRING'] . "<br>";
        parse_str($_SERVER['QUERY_STRING'], $args);
        print "Formatted query string: <br>";
        if(count($args) > 1){
            foreach($args as $key => $value) {
                print "$key=$value<br>";
            }
        }

    }
    else {
        print "Raw query string: <br>";
        print "Formatted query string: ";
    }
?>