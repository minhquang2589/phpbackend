const express = require('express');
const mysql = require('mysql');
const app = express();

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'myweblaravel' 
});

connection.connect(err => {
    if (err) {
        console.error('Error connecting to MySQL:', err);
        return;
    }
    console.log('Connected to MySQL');
});
app.get('/api/users', (req, res) => {
    const sql = 'SELECT * FROM users'; 
    connection.query(sql, (err, results) => {
        if (err) {
            console.error('Error querying MySQL:', err);
            res.status(500).json({ error: 'Internal Server Error' });
            return;
        }
        res.json(results);
    });
});

const port = 5000; 
app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
