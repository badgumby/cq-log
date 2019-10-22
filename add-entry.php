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
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query for callsign lookup
$stmnt1 = $mysqli->prepare("SELECT callsign FROM logs WHERE callsign = ?");
$stmnt1->bind_param("s", $callsign);
$stmnt1->execute();
$result = $stmnt1->get_result();
$stmnt1->close();

//$sql1 = "SELECT callsign FROM logs WHERE callsign = '$callsign'";
//$result = $mysqli->query($sql1);

// Check if callsign was found
if ($result->num_rows === 0 or $allowDuplicates === TRUE) {
  // Insert new data
  try {
    $stmnt2 = $mysqli->prepare("INSERT INTO logs (callsign, sequence, frequency, band, date, location, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmnt2->bind_param("sisssss", $callsign, $sequence, $frequency, $band, $date, $location, $notes);
    $stmnt2->execute();
    $result2 = $stmnt2->get_result();
    var_dump($result2);

    //if ($mysqli->query($sql2) === TRUE) {
    //  echo "New record created successfully";
    //} else {
    //  echo "Error: " . $sql2 . "<br>" . $mysqli->error;
    //}
    $stmnt2->close();
  } catch(Exception $e) {
    echo $e;
  }
} else {
  echo "Duplicate callsign ($callsign) found.";
}

$mysqli->close();

 ?>
