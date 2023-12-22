const express = require('express');
const app = express();

app.get('/', (req, res) => {
  const date = new Date();
  res.setHeader('Cache-Control', 'no-cache');
  res.setHeader('Content-Type', 'text/html');
  res.write('<html><head><title>Hello CGI World</title></head><body><h1 align=center>Hello HTML World!</h1><hr/>');
  res.write('Hello World<br/>');
  res.write('This page was generated with the Node.js programming language<br/>');
  res.write(`This program was generated at: ${date}<br/>`);
  res.write(`Your current IP address is: ${req.ip}<br/>`);
  res.write('</body></html>');
  res.end();
});

app.listen(3000, () => {
  console.log('Server running on port 3000');
});
