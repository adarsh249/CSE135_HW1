#!/usr/bin/env ruby

require 'cgi'
require 'cgi/session'

cgi = CGI.new

session = CGI::Session.new(cgi, :driver => :File, :tmpdir => "/tmp")

# Create a new Cookie from the Session ID

if cgi.has_key?('username') and cgi['username'] != ''
    name = cgi['username']
else
    name = cgi.cookies['CGISESSID'].to_s.match(/CGISESSID=([^;]+)/)[1].split('&')[1]
end
session['username'] = name

cookie = CGI::Cookie.new('name' => 'CGISESSID', 'value' => [session.session_id, name])

puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts "Set-Cookie: #{cookie}"
puts

# puts "#{cgi['username']}"
# puts "#{session}"
puts '<html><head><title>Ruby Sessions</title></head>'
puts '<body><h1 align=center>Ruby Sessions Page 1</h1><hr/>'

# print name unless none was provided
name.empty? ? (puts '<b>Name:</b> None') : (puts "<b>Name:</b> #{name}")

puts '<br/><br/>'
puts '<a href="/cgi-bin/Ruby/ruby-sessions-2.rb">Session Page 2</a><br/>'
puts '<a href="/cgi-bin/Ruby/ruby-state-demo.rb">Ruby CGI Form</a><br/>'
puts '<form action="/cgi-bin/Ruby/ruby-destroy-session.rb" method="get" id="form">'
puts '<button type="submit">Destroy Session</button>'
puts '</form>'
puts '</body></html>'
