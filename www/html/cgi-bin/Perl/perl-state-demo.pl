#!/usr/bin/perl

print "Cache-Control: no-cache\n";
print "Content-type: text/html\n\n";
print <<END;
<!DOCTYPE html>
<html>

<head>
  <title>CGI Form</title>
</head>

<body>
  <h1 align="center">Session Test</h1>
  <hr>
  <label for="cgi-lang">CGI using Perl</label>
  <form action="/cgi-bin/Perl/perl-sessions-1.pl" method="Post" id="form">
    <label>What is your name? <input type="text" name="username" autocomplete="off"></label>
    <br>
    <input type="submit" value="Test Sessioning">
  </form>
  
  <a href="/" style="display:inline-block;margin-top:20px;">Home</a> 

</body>

</html>
END
