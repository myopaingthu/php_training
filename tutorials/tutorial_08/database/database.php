<?php
// Used to connect to the database
$host = "localhost";
$db_name = "tutorial8";
$username = "root";
$password = "password";
// Connect to database
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
// Show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
