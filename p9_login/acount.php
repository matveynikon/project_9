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

$email = $_POST["e-mail"];
$upass = $_POST["password"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$emailcheck = $conn->query("SELECT fname FROM users2 WHERE email = '$email'");
$row=$emailcheck->fetch_assoc();
echo('Hello there' . $row["fname"]);
session_start(); 
$_SESSION["name"] = $row["fname"]; 
$conn->close();
?>
<form id="sd" action="new.php" method="post" ><b>
Hours worked today: <input type="text" name="work"><br>
<br>
<button id="go" action="new.php" type="submit">Go!</button>
</form> 
</body>
</html>