<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.workgraph{
  width: 60%;
  position: absolute;
  left: 7%;
  top: 7%;
}
</style>
</head>
<body>
<div class="workgraph">
  <canvas id="myChart"></canvas>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "Willink+1";
$dbname = "myDB";

$uname = $_POST["name"];
$email = $_POST["e-mail"];
$upass = $_POST["password"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users2 (fname, email, encpassword)
VALUES ('$uname', '$email', '$upass')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sqlname = "SELECT fname FROM users2";
$result = $conn->query($sqlname);

$namedata = array();
if ($result->num_rows > 0) {
  // output data of each row
  $names = array();
  while($row = $result->fetch_assoc()) {
    array_push($names, $row['fname']);
  }
  if (in_array($uname, $names)){
    echo($uname);
  }
  else{
    echo('No name found');
  }
} else {
  echo "0 results";
}

$userDB = "CREATE TABLE $uname (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  workhours CHAR(30),
  udate CHAR(30),
  uname CHAR(30)
  )";
  
  if ($conn->query($userDB) === TRUE) {
    echo "Table for new user created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

session_start(); 
$_SESSION["name"] = $uname; 
$conn->close();
?>
<form id="sd" action="new.php" method="post" ><b>
Hours worked today: <input type="text" name="work"><br>
<br>
<button id="go" action="new.php" type="submit">Go!</button>
</form> 
</body>
</html>