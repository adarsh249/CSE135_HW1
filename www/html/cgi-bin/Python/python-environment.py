#!/usr/bin/env python3

import os
import cgitb
cgitb.enable()

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("""<!DOCTYPE html>
<html>
<head>
<title>Environment Variables</title>
</head>
<body><h1 align="center">Environment Variables</h1>
<hr>
""")

for k,v in os.environ.items():
    print(f"<b>{k}:</b> {v}<br/>")

print("</body></html>")
