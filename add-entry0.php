<?php

include('config.php');

$callsign = $_POST['callsign'];
$sequence = $_POST['sequence'];
$frequency = $_POST['frequency'];
$band = $_POST['band'];
$date = $_POST['date'];
$location = $_POST['location'];
$notes = $_POST['notes'];

// Is allowDuplicates checked?
if ($_POST['allowDuplicates'] == 'on') {
  $allowDuplicates = TRUE;
} else {
  $allowDuplicates = FALSE;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for callsign lookup
$sql1 = "SELECT callsign FROM logs WHERE callsign = '$callsign'";
$result = $conn->query($sql1);

// Check if callsign was found
if ($result->num_rows <= 0 or $allowDuplicates === TRUE) {
    // Insert new data
    $sql2 = "INSERT INTO logs (callsign, sequence, frequency, band, date, location, notes)
    VALUES ('$callsign', '$sequence', '$frequency', '$band', '$date','$location', '$notes')";

    if ($conn->query($sql2) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
  } else {
    echo "Duplicate callsign ($callsign) found.";
  }

$conn->close();

 ?>
