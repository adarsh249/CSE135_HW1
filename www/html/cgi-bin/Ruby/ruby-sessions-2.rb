#!/usr/bin/env ruby

require 'cgi'
require 'cgi/session'
require 'securerandom'

cgi = CGI.new

# # Access Ruby Session
session = CGI::Session.new(cgi, :session_key => 'CGISESSID', :tmpdir => '/tmp')

puts "Cache-Control: no-cache"
puts "Content-Type: text/html\n\n"

cgi = CGI.new
# puts "#{cgi.cookies['CGISESSID']}"
sess_id = cgi.cookies['CGISESSID'].to_s.match(/CGISESSID=([^;]+)/)[1]
# puts "#{sess_id}"
name = sess_id.split('&')[1]
# puts "#{name}"
# name = cookies['username'].value if cookies && cookies['username']
# puts "#{name}"
# session_id = cookie.value if cookie

# puts "Session ID: #{session_id}"

# # Access Stored Data
# name = session['username']

# sid = cgi.cookies['CGISESSID'] ? cgi.params['sid'] : SecureRandom.uuid
# puts "#{cgi.cookies['CGISESSID']}"
# puts "#{CGI::Cookie.parse(cgi.env['HTTP_COOKIE'])}"
# session = CGI::Session.new(cgi, {'new_session' => false})
# name = session['username']


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
