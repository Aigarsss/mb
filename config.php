<?php
$host = "localhost";
$userName = "root";
$password = "";
$dbName = "mbdb";

// data source name
$dsn = 'mysql:host='. $host .';dbname='. $dbName;


// Create database connection
$conn = new PDO($dsn, $userName, $password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



