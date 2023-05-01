#!/usr/bin/env ruby

require 'json'

puts 'Cache-Control: no-cache'
puts 'Content-type: application/json'
puts
puts JSON.generate({
    'message' => 'Hello, World!',
    'language' => 'Ruby',
    'date' => Time.now,
    'current_ip' => ENV['REMOTE_ADDR']
})
