#!/usr/bin/env python3

import os
from datetime import datetime
import cgitb
cgitb.enable()

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("<html>")
print("<head>")
print("<title>Hello CGI World</title>")
print("</head>")
print("<body>")

print("<h1 align=center>Hello HTML World!</h1><hr/>")
print("<p>Hello World</p>")
print("<p>This page was generated with the Python programming langauge</p>")

# Wed Apr 26 21:10:31 2023
print(f"<p>This program was generated at: {datetime.now().strftime('%a %b %d %H:%M:%S %Y')}</p>")

# IP Address is an environment variable when using CGI
print(f"<p>Your IP Address: {os.environ.get('REMOTE_ADDR')}</p>")

print("</body>")
print("</html>")
