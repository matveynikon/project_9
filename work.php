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

$worktime = $_POST["work"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$mydate=getdate(date("U"));
echo "$mydate[month], $mydate[mday], $mydate[year]";
$curdate = "$mydate[month] $mydate[mday]";
echo($curdate);
$sql = "INSERT INTO workdata2 (workhours, cdate)
VALUES ('$worktime', '$curdate')";

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

$sqlwork = "SELECT workhours FROM workdata2";
$result = $conn->query($sqlwork);

$workdata = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "workhours: " . $row["workhours"] . "<br>";
    array_push($workdata, $row["workhours"]);
  }
} else {
  echo "0 results";
}
$sqldate = "SELECT cdate FROM workdata2";
$result = $conn->query($sqldate);

$dates = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    array_push($dates, $row["cdate"]);
  }
} else {
  echo "0 dates";
}
$conn->close();
?>
<script>
const labels = <?=json_encode($dates)?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: <?=json_encode($workdata)?>,
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