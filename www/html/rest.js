const express = require('express');
const fs = require("fs");
const mysql = require('mysql2');
const app = express();
const PORT = 9000; 
app.use(express.json());

app.set('json spaces', 2);

const dataFilePath = "restTest.json";
const readDataFromFile = () => {
    try {
      const data = fs.readFileSync(dataFilePath, 'utf8');
      return JSON.parse(data);
    } catch (error) {
      console.error('Error reading data from file:', error);
      return [];
    }
}; 

// Write the data to the JSON file
const writeDataToFile = (data) => {
    try {
      fs.writeFileSync(dataFilePath, JSON.stringify(data, null, 2), 'utf8');
    } catch (error) {
      console.error('Error writing data to file:', error);
    }
};

// Connection Constant to mySQL
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "123",
  database: "userdata"
});

connection.connect((err) => {
  if (err) {
    console.error('Error connecting to database:', err);
    return;
  }
  console.log('Connected to MySQL server!');
});

// GET /api/static - Retrieve all static entries
const getAll = (database) => {
  return (req, res) => {
    const sql = `SELECT * FROM userdata.${database}`;

    connection.query(sql, (err, result) => {
      if (err) {
        console.error('Error retrieving data:', err);
        res.status(500).json({ error: 'Error retrieving data from database' });
        return;
      }

      res.status(200).json(result);
    });
  };
};

// GET /api/static/:id - Retrieve a specific static entry by ID
const getOne = (database) => {
  return (req, res) => {
    const id = req.params.id;
    const sql = `SELECT * FROM ${database} WHERE id = ?`;
    
    connection.query(sql, [id], (err, result) => {
      if (err) {
        console.error('Error retrieving data:', err);
        res.status(500).json({ error: 'Error retrieving data from database' });
        return;
      }
      
      if (result.length === 0) {
        res.status(404).json({ message: 'Data not found' });
        return;
      }
      
      let data;

      const entry = result[0];
      switch (database) {
        case 'static':
          data = {
            id: entry.id,
            userSessionID: entry.userSessionID,
            userAgent: entry.userAgent,
            userLanguages: JSON.parse(entry.userLanguages),
            userPreferredLanguage: entry.userPreferredLanguage,
            userCookiesEnabled: entry.userCookiesEnabled,
            userScreenDimensions: JSON.parse(entry.userScreenDimensions),
            userWindowDimensions: JSON.parse(entry.userWindowDimensions),
            userNetworkConnectionType: entry.userNetworkConnectionType
          };
          break;
        case 'performance':
          data = entry;
          break;
        case 'activity':
          data = {
            id: entry.id,
            userSessionID: entry.userSessionID,
            userTimeEntered: JSON.parse(entry.userTimeEntered),
            userTimeLeft: JSON.parse(entry.userTimeLeft),
            idleTimes: JSON.parse(entry.idleTimes),
            errors: JSON.parse(entry.errors),
            keyboardActivity: JSON.parse(entry.keyboardActivity),
            mouseActivity: JSON.parse(entry.mouseActivity)
          }
          break;
        default:
          console.log(`Unknown database ${database}. idk this really shouldn't be thrown`);
      }
      
      res.status(200).json(data);
    });
  };
};

// Create a new static entry
const createVal = (database) => {
  return (req, res) => {

    console.log(req.body);
    const userSessionID = req.body.userSessionID;

    // Check for duplicate ID
    const duplicateCheckQuery = `SELECT * FROM ${database} WHERE userSessionID = ?`;
    const duplicateCheckValue = userSessionID;

    connection.query(duplicateCheckQuery, duplicateCheckValue, (err, result) => {

      console.log(req.body);
      console.log(Object.keys(req.body));
      const keys = Object.keys(req.body);

      const sql = `INSERT INTO ${database} (${keys.join(', ')}) VALUES (${Array(keys.length).fill('?').join(', ')})`;

      const values = Object.values(req.body).flatMap(value => (
        Array.isArray(value) || typeof value === 'object' ? 
        JSON.stringify(value) : value
      ));

      connection.query(sql, values, (err, result) => {
        if (err) {
          console.error('Error inserting data:', err);
          res.status(500).json({ error: 'Error inserting data into database' });
          return;
        }
        res.status(201).json({ 
          message: 'Data inserted successfully',
          result: result
        });
      });
    });
  };
};

// DELETE /api/static/:id - Delete a specific static entry by ID
const deleteVal = (database) => {
  return (req, res) => {
    const { id } = req.params;
    const sql = `DELETE FROM ${database} WHERE id = ?`;

    connection.query(sql, [id], (err, result) => {
      if (err) {
        console.error('Error deleting data:', err);
        res.status(500).json({ error: 'Error deleting data from the database' });
        return;
      }

      if (result.affectedRows === 0) {
        res.status(404).json({ error: 'Data not found' });
        return;
      }

      res.status(200).json({ message: 'Data deleted successfully', deleted: result });
    });
  };
};

// PUT /api/static/:id - Update a specific static entry by ID
const updateVal = (database) => {
  return (req, res) => {
    const id = req.params.id;
    const sql = `UPDATE userdata.${database} SET ${Object.keys(req.body).flatMap(key => key + '= ?').join(', ')} WHERE id = ${id}`;
    let values = Object.values(req.body).flatMap(value => (
      Array.isArray(value) || typeof value === 'object' ? 
      JSON.stringify(value) : value
    ));
    connection.query(sql, values, (err, result) => {
      if (err) {
        console.error('Error updating data:', err);
        res.status(500).json({ error: 'Error updating data in the database' });
        return;
      }
      res.status(200).json({ message: 'Data updated successfully', result: result });
    });
  };
};

const endpoints = [
  'static',
  'performance',
  'activity'
];

endpoints.forEach((endpoint) => {
  app.get(`/${endpoint}`, getAll(endpoint));
  app.get(`/${endpoint}/:id`, getOne(endpoint));
  app.post(`/${endpoint}`, createVal(endpoint));
  app.delete(`/${endpoint}/:id`, deleteVal(endpoint));
  app.put(`/${endpoint}/:id`, updateVal(endpoint));  
});



// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});

process.on('uncaughtException', (err) => { console.log(err); });
