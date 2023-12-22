#!/usr/bin/env python3

import os
import re
import cgi
import cgitb
cgitb.enable()

print('''Cache-Control: no-cache
Content-type: text/html
''')

name: str
cookie = os.environ.get('HTTP_COOKIE')
if cookie is not None and 'destroyed' not in cookie:
    # match = re.search(r"name=([^;]+)", cookie)
    # name = match.group(1) if match else 'Nah'
    name = cookie
else:
    name = 'None'

print(f'''
<!DOCTYPE html>
<html>
    <head>
        <title>Python Sessions</title>
    </head>
    <body>
        <h1>Python Sessions Page 2</h1>
        <table>
            <tr>
                <td>Cookie:</td>
                <td>{name}</td>
            </tr>
        </table>
        <br/>
        <a href="/cgi-bin/Python/python-sessions-1.py">Session Page 1</a>
        <br/>
        <a href="/cgi-bin/Python/python-state-demo.py">Python CGI Form</a>
        <br/>
        <form action="/cgi-bin/Python/python-destroy-session.py" method="GET">
            <button type="submit">Destroy Session</button>
        </form>
    </body>
</html>
''')
