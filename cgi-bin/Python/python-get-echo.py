#!/usr/bin/env python3

import os
import cgitb
cgitb.enable()

print(f'''Cache-Control: no-cache
Content-type: text/html

<!DOCTYPE html>
<html>
<head>
<title>GET Request Echo</title>
</head>
<body><h1 align="center">Get Request Echo</h1>
<hr>
Raw query string: {os.environ.get('QUERY_STRING')}
<br/><br/>
<table>
<thead><td>Formatted Query String:</td></thead>
<tbody><tr><td>
{os.environ.get('QUERY_STRING').replace("&", "</td></tr><tr><td>").replace("=", ": ")}
</td></tr></tbody>
</table>
</body>
</html>
''')
