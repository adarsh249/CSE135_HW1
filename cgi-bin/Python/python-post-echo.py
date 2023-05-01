#!/usr/bin/env python3

import os
import sys
import cgitb
cgitb.enable()

print(f'''Cache-Control: no-cache
Content-type: text/html

<!DOCTYPE html>
<html>
    <head>
        <title>POST Request Echo</title>
    </head>
<body>
    <h1 align="center">Post Request Echo</h1>
    <hr>
    <b>Message Body:</b>
    <br/>
    <ul>
        <li>
            {sys.stdin.read().replace("&", 
"""
        </li>
    </ul>
    <ul>
        <li>
            """)}
        </li>
    </ul>
</body>
</html>
''')
