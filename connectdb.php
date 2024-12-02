<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ambulance';


$con = new mysqli($hostname, $username, $password, $dbname);

if($con->connect_error){
    die("Connection Error". mysqli_connect_error());
}

$createTable = "CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT,
    fullname VARCHAR(225),
    email VARCHAR(50),
    `password` VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);";

$create= $con->query($createTable);

?>
