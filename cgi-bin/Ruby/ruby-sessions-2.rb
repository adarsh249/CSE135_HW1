#!/usr/bin/env ruby

require 'cgi'
require 'cgi/session'

cgi = CGI.new
# get the session ID from the cookie unless it doesn't exist
sid = cgi.cookies['CGISESSID'] ? cgi.cookies['CGISESSID'].first : nil