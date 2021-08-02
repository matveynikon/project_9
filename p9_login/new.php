<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>many men</title>
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
session_start(); 
$work = $_POST["work"];
$DBname = $_SESSION["name"];

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

$mydate=getdate(date("U"));
echo "$mydate[month], $mydate[mday], $mydate[year]";
$curdate = "$mydate[month] $mydate[mday]";
echo($curdate);

$sql = "INSERT INTO $DBname (workhours, udate, uname)
VALUES ('$work', '$curdate', '$DBname')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sqldate = "SELECT udate FROM $DBname";
$result = $conn->query($sqldate);

$dates = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    array_push($dates, $row["udate"]);
  }
} else {
  echo "0 dates";
}

$sqlwork = "SELECT workhours FROM $DBname";
$workres = $conn->query($sqlwork);

$work = array();
if ($workres->num_rows > 0) {
  // output data of each row
  while($row = $workres->fetch_assoc()) {
    array_push($work, $row["workhours"]);
  }
} else {
  echo "0 workhours so far";
}

?>
<script>
const labels = <?=json_encode($dates)?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: <?=json_encode($work)?>,
  }]
};
// </block:setup>

// <block:config:0>
const config = {
  type: 'line',
  data: data,
  options: {}
};
// </block:config>

module.exports = {
  actions: [],
  config: config,
};
</script>

<script>
  // === include 'setup' then 'config' above ===

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</body>
</html>