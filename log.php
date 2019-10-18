<?php

include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<table class="logTable">
  <tr>
    <th>
      Order
    </th>
    <th>
      Callsign
    </th>
    <th>
      Sequence
    </th>
    <th>
      Frequency (MHz)
    </th>
    <th>
      Band
    </th>
    <th>
      Location
    </th>
    <th>
      Date
    </th>
    <th>
      Notes
    </th>
  </tr>
<?php

$sql = "SELECT callsign, sequence, band, date, frequency, location, notes, ident FROM logs ORDER BY ident DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>
      <tr>
        <td>
          <?php echo $row["ident"]; ?>
        </td>
        <td>
          <?php echo $row["callsign"]; ?>
        </td>
        <td>
          <?php echo $row["sequence"]; ?>
        </td>
        <td>
          <?php echo $row["frequency"]; ?>
        </td>
        <td>
          <?php echo $row["band"]; ?>
        </td>
        <td>
          <?php echo $row["location"]; ?>
        </td>
        <td>
          <?php echo $row["date"]; ?>
        </td>
        <td>
          <?php echo $row["notes"]; ?>
        </td>
      </tr>
      <?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</table>
