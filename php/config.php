<?php


define (DB_USER, "u769955481_mybalance");
define (DB_PASSWORD, "mybalance@123");
define (DB_DATABASE, "u769955481_mybalance");
define (DB_HOST, "sql328.main-hosting.eu");


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>