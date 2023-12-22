const express = require('express');
//const mysql = require('mysql2');
const bodyParser = require('body-parser');
const app = express();

// Create MySQL connection

  


// Middleware to parse request bodies
app.use(bodyParser.urlencoded({ extended: true }));


// Start the server
app.listen(7000, () => {
  console.log('Server started on port 3000');
});
