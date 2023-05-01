puts 'Cache-Control: no-cache'
puts 'Content-type: text/html'
puts
puts '<html><head><title>POST Request Echo</title></head>'
puts '<body><h1 align=center>POST Request Echo</h1><hr/>'

puts '<b>Message Body:</b><br/>'
puts '<ul>'

form_data = STDIN.read.split('&')
form_data.each do |pair|
    puts "<li>#{pair.split('=')[0]}=#{pair.split('=')[1]}<br/></li>"
end

puts '</ul>'
puts '</body></html>'
