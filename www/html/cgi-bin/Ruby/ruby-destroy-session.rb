#!/usr/bin/env ruby

require 'cgi'
require 'cgi/session'

cgi = CGI.new
session = CGI::Session.new(cgi, :driver => :File, :tmpdir => "/tmp")
cookie = CGI::Cookie.new('name' => 'CGISESSID', 'value' => [session.session_id, "None"])

# # cgi = CGI.new
# sid = cgi.cookies['CGISESSID'] ? cgi.params['sid'] : nil
# session = CGI::Session.new(cgi, {'sid' => sid, 'new_session' => false})

# # Remove the username key from the session data
# session.delete('username')

# # Reset the CGISESSID cookie to an empty value with an expiration in the past
# cookie = CGI::Cookie.new('name' => 'CGISESSID', 'value' => '', 'expires' => Time.now - 3600)
# cgi.header['Set-Cookie'] = cookie

# sid = cgi.cookies['CGISESSID'] ? cgi.params['sid'] : nil
# session = CGI::Session.new(cgi, {'sid' => sid, 'new_session' => false})
# session.delete

# begin
#     session = CGI::Session.new(cgi, 'new_session' => false)
#     session.delete
#     session = CGI::Session.new(cgi, :driver => :File, :tmpdir => "/tmp")
#     session.close
#     cookie = CGI::Cookie.new('name' => 'CGISESSID', 'value' => [session.session_id, "None", "nONE", "nada"])
#     cgi.header['Set-Cookie'] = cookie
# rescue ArgumentError  # if no old session
# end

puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts "Set-Cookie: #{cookie}"
puts
puts '<html><head><title>Ruby Session Destroyed</title></head>'
# puts "Set-Cookie: #{cookie}"
puts '<body><h1 align=center>Session Destroyed</h1><hr/>'
puts '<a href="/cgi-bin/Ruby/ruby-state-demo.rb">Ruby CGI Form</a><br/>'
puts '<a href="/cgi-bin/Ruby/ruby-sessions-1.rb">Back to Page 1</a><br/>'
puts '<a href="/cgi-bin/Ruby/ruby-sessions-2.rb">Back to Page 2</a><br/>'
puts '</body></html>'
