#!/usr/bin/env python3

import os
import cgi
import cgitb
from http import cookies

cgitb.enable()

print('''Cache-Control: no-cache
Content-type: text/html
Set-Cookie: destroyed
''')

# cookie = cookies.SimpleCookie(os.environ.get('HTTP_COOKIE'))
# cookie["name"]['expires'] = 'Thu, 01 Jan 1970 00:00:00 GMT'
# os.environ.pop('HTTP_COOKIE', None)

print(f'''
<html>
    <head>
        <title>Python Session Destroyed</title>
    </head>
    <body>
        <h1>Session Destroyed</h1>
        <a href="/cgi-bin/Python/python-state-demo.py">Back to the Python CGI Form</a>
        <br/>
        <a href="/cgi-bin/Python/python-sessions-1.py">Back to Page 1</a>
        <br/>
        <a href="/cgi-bin/Python/python-sessions-2.py">Back to Page 2</a>
        <br/>
    </body>
</html>
''')
