<?php

include('config.php');

$callsign = $_POST['callsign'];
$sequence = $_POST['sequence'];
$frequency = $_POST['frequency'];
$band = $_POST['band'];
$date = $_POST['date'];
$location = $_POST['location'];
$notes = $_POST['notes'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO logs (callsign, sequence, frequency, band, date, location, notes)
VALUES ('$callsign', '$sequence', '$frequency', '$band', '$date','$location', '$notes')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo $callsign;

 ?>
