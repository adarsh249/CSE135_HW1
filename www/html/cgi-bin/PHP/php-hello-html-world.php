<?php
    header('Content-Type: text/html');
    header('Cache-Control: no-cache');
?>
<?php
    print "<html><head><title>Hello PHP World</title></head>";
    print "<body><h1 align=center>Hello HTML World!</h1><hr/>\n";
    print "<p>Hello PHP World</p><br>\n";
    print "<p>This program was generated at: " . date("Y-m-d H:i:s") . "</p>";
    print "<p>Your Current IP address is: " . $_SERVER['REMOTE_ADDR'] . "</p>";
?>
<?php
    print "</body></html>";
?>