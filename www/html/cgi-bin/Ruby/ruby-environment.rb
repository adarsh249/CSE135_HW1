#!/usr/bin/env ruby

puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts
# print HTML file top of Ruby environment variables
puts '<html><head><title>Environment Variables</title></head>'
puts '<body><h1 align=center>Environment Variables</h1><hr/>'
# Loop over the environment variables and print each variable and its value
puts '<table border="1" align="center">'
puts '<tr><th>Environment Variable</th><th>Value</th></tr>'
ENV.each do |key, value|
    puts "<tr><td><b>#{key}:</b></td><td>#{value}</td></tr>"
end
puts '</table>'
puts '</body></html>'
