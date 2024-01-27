// En db.js

const mysql = require('mysql');

const connection = mysql.createConnection({
  host: 'buadsk8r1fzl7mhuddzq-mysql.services.clever-cloud.com',
  user: 'uxhzzongdcnx8frz',
  password: 'pcqZ5XgYVnA1gI5Tv4ru',
  database: 'buadsk8r1fzl7mhuddzq'
});

connection.connect((error) => {
  if (error) {
    console.error('Error al conectar a la base de datos:', error);
  } else {
    console.log('Conexión exitosa a la base de datos');
  }
});

module.exports = connection;
