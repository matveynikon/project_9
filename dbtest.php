<?php
$servername = "localhost";
$username = "root";
$password = "Willink+1";
$dbname = "myDB";

// Create connection
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE workdata2 (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    workhours VARCHAR(20),
    cdate CHAR(30)
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table MyGuests created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();
?>