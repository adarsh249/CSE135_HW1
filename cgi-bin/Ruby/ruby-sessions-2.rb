#!/usr/bin/env ruby

require 'cgi'
require 'cgi/session'

# Access Perl Session
session = CGI::Session.new(CGI.new, :cookie_only => false, :session_key => 'CGISESSID', :tmpdir => '/tmp')

# Access Stored Data
name = session['username']

puts "Content-Type: text/html\n\n"

puts "<html>"
puts "<head>"
puts "<title>Perl Sessions</title>"
puts "</head>"
puts "<body>"

puts "<h1>Perl Sessions Page 2</h1>"

if name
	puts("<p><b>Name:</b> #{name}")
else
	puts "<p><b>Name:</b> You do not have a name set</p>"
end

puts "<br/><br/>"
puts "<a href=\"/cgi-bin/perl-sessions-1.pl\">Session Page 1</a><br/>"
puts "<a href=\"/perl-cgiform.html\">Perl CGI Form</a><br />"
puts "<form style=\"margin-top:30px\" action=\"/cgi-bin/perl-destroy-session.pl\" method=\"get\">"
puts "<button type=\"submit\">Destroy Session</button>"
puts "</form>"

puts "</body>"
puts "</html>"
