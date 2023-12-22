#!/usr/bin/env ruby

puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts
puts '<html><head><title>General Request Echo</title></head>'
puts '<body><h1 align=center>General Request Echo</h1><hr/>'

# HTTP Protocol, HTTP Method, and the Query String are all environment variables
puts "<p><b>HTTP Protocol:</b> #{ENV['SERVER_PROTOCOL']}</p>"
puts "<p><b>HTTP Method:</b> #{ENV['REQUEST_METHOD']}</p>"
puts "<p><b>Query String:</b> #{ENV['QUERY_STRING']}</p>"

# Message Body
puts "<b>Message Body:</b> #{STDIN.read()}"

puts '</body></html>'
