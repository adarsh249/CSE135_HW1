puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts
puts '<html><head><title>GET Request Echo</title></head>'
puts '<body><h1 align=center>GET Request Echo</h1><hr/>'

# print query string
puts '<b>Query String:</b> <code>#{ENV['QUERY_STRING']}</code><br/>'

# print formatted query string
puts '<b>Formatted Query String:</b><br/>'
puts '<table border="1" align="center">'
puts '<tr><th>key</th><th>value</th></tr>'
ENV['QUERY_STRING'].split('&').each do |pair|
    puts "<tr><td>#{pair.split('=')[0]}</td><td>#{pair.split('=')[1]}</td></tr>"
end
puts '</table>'
puts '</body></html>'
