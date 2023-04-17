# CSE135_HW1
<https://cse151group111.online>

## Team Members:
- Adarsh Patel
- Bill (Yunze) Xie
- Gary Lin

## Grader password
password: `123`
SSH Private Key below or in id_rsa file given.

## Details of Github auto deploy setup
## Username/password info for logging into site
usernames: 
- `adarsh` 
- `bill`
- `gary`
- `grader`
pass for all users: `123`
## Summary of changes to HTML file in DevTools after compression
There are no changes to the HTML file. This makes sense because users should not be able to see on their end the HTML file compressed. However, under Response Headers, we can see that Content-Encoding is gzip, so we are compressing pages.
## Summary of removing 'server' header
In `/etc/apache2/conf-available/security.conf`, we set `ServerTokens Full` and `ServerSignature On`. Then, in `/etc/apache2/apache2.conf`, we added lines 228 to 234 below:

```<IfModule mod_headers.c>
Header always set Server "CSE 135 Server"
</IfModule>

<IfModule mod_security2.c>
SecServerSignature "CSE 135 Server"
</IfModule>```

These lines alawys set the home page's server signature and every path on the site, including error 404, to have a response header of "CSE 135 Server".
