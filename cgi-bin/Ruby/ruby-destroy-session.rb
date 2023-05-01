require 'cgi'
require 'cgi/session'

cgi = CGI.new
sid = cgi.cookies['CGISESSID'] ? cgi.params['sid'] : nil
session = CGI::Session.new(cgi, {'sid' => sid, 'new_session' => false})
session.delete

puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts
puts '<html><head><title>Ruby Session Destroyed</title></head>'
puts '<body><h1 align=center>Session Destroyed</h1><hr/>'
puts '<a href="/cgi-bin/Ruby/ruby-state-demo.rb">Ruby CGI Form</a><br/>'
puts '<a href="/cgi-bin/Ruby/ruby-sessions-1.rb">Back to Page 1</a><br/>'
puts '<a href="/cgi-bin/Ruby/ruby-sessions-2.rb">Back to Page 2</a><br/>'
puts '</body></html>'
