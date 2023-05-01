#!/usr/bin/env python3

# Create a new Python Session
from http.cookies import SimpleCookie
from uuid import uuid4
import os
import re
import cgi
import cgitb
cgitb.enable()

print('''Cache-Control: no-cache
Content-type: text/html''')

name: str
c = cgi.FieldStorage()

if 'username' in c.keys() and (name := c.getvalue('username')) and len(name) > 0:
    # cookie = SimpleCookie()
    # cookie['name'] = name
    # print(cookie.output())
    print(f'Set-Cookie: {name}')
    print()

elif 'HTTP_COOKIE' in os.environ and (cookie := os.environ.get('HTTP_COOKIE')) and 'destroyed' not in cookie:
    name = cookie
    # cookie = os.environ.get('HTTP_COOKIE')
    # if cookie is not None and 'destroyed' not in cookie:
        # match = re.search(r"name=([^;]+)", cookie)
        # name = match.group(1) if match else 'None'
else:
    name = 'None'

print(f'''
<!DOCTYPE html>
<html>
    <head>
        <title>Python Sessions</title>
    </head>
    <body>
        <h1>Python Sessions Page 1</h1>
        <table>
            <tr>
                <td>Cookie:</td>
                <td>{name}</td>
            </tr>
        </table>
        <br/>
        <a href="/cgi-bin/Python/python-sessions-2.py">Session Page 2</a>
        <br/>
        <a href="/cgi-bin/Python/python-state-demo.py">Python CGI Form</a>
        <br/>
        <form action="/cgi-bin/Python/python-destroy-session.py" method="GET">
            <button type="submit">Destroy Session</button>
        </form>
    </body>
</html>
''')
