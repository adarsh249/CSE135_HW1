#!/usr/bin/env ruby

puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts
puts '<html><head><title>State Demo</title></head>'
puts '<body><h1 align=center>Session Test</h1><hr/>'
puts '<label for="cgi-lang">CGI using Ruby</label>'
puts '<form action="/cgi-bin/Ruby/ruby-sessions-1.rb" method="post" id="form">'
puts '<label>What is your name? <input type="text" name="username" autocomplete="off"></label><br/>'
puts '<input type="submit" value="Test Sessioning" id="submit">'
puts '</form>'
puts '<a href="/" style="display:inline-block;margin-top:20px;">Home</a>'
puts '</body></html>'
