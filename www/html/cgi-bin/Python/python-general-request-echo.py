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
        <title>General Request Echo</title>
    </head>
    <body>
        <h1 align="center">General Request Echo</h1>
        <hr>
        <p><b>HTTP Protocol:</b> {os.environ.get("SERVER_PROTOCOL")}</p>
        <p><b>HTTP Method:</b> {os.environ.get("REQUEST_METHOD")}</p>
        <p><b>Query String:</b> {os.environ.get("QUERY_STRING")}</p>
        <p><b>Message Body:</b> {sys.stdin.read()}</p>
    </body>
</html>
''')