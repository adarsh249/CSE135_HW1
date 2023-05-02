#!/usr/bin/env ruby

require 'cgi'
require 'cgi/session'

# Access Ruby Session
session = CGI::Session.new(CGI.new, :cookie_only => false, :session_key => 'CGISESSID', :tmpdir => '/tmp')

# Access Stored Data
name = session['username']

puts "Cache-Control: no-cache"
puts "Content-Type: text/html\n\n"

puts "<html><head><title>Ruby Sessions</title></head>"
puts "<body><h1 align=center>Ruby Sessions Page 2</h1><hr/>"

name ?	(puts "<p><b>Name:</b> #{name}") : (puts "<p><b>Name:</b> None</p>")

puts "<br/><br/>"
puts "<a href=\"/cgi-bin/Ruby/ruby-sessions-1.rb\">Session Page 1</a><br/>"
puts "<a href=\"/cgi-bin/Ruby/ruby-state-demo.rb\">Ruby CGI Form</a><br />"
puts "<form style=\"margin-top:30px\" action=\"/cgi-bin/Ruby/ruby-destroy-session.rb\" method=\"get\">"
puts "<button type=\"submit\">Destroy Session</button>"
puts "</form>"

puts "</body>"
puts "</html>"
