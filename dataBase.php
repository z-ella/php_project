<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDataBase"; 

// Create connection
$connDb = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connDb) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
