<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
<div style="width: 50%;">
  <canvas id="myChart"></canvas>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "Willink+1";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT workhours FROM workdata";
$result = $conn->query($sql);

$workdata = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "workhours: " . $row["workhours"] . "<br>";
    array_push($workdata, $row["workhours"]);
    var_dump($workdata);
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<script>
const labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
];
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