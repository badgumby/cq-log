<?php

include('config.php');

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

// Post the stuff
} else {

$dbtable = $_SESSION['username'];
$callsign = $_POST['callsign'];
$sequence = $_POST['sequence'];
$frequency = $_POST['frequency'];
$band = $_POST['band'];
$date = $_POST['date'];
$state = $_POST['state'];
$country = $_POST['country'];
$rstr = $_POST['rstr'];
$rsts = $_POST['rsts'];
$notes = $_POST['notes'];

// Is allowDuplicates checked?
if ($_POST['allowDuplicates'] == 'on') {
  $allowDuplicates = TRUE;
} else {
  $allowDuplicates = FALSE;
}

// Create connection
$mysqli = new mysqli($servername, $dbuser, $dbpass, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query for callsign lookup
$stmnt1 = $mysqli->prepare("SELECT callsign FROM $dbtable WHERE callsign = ?");
$stmnt1->bind_param("s", $callsign);
$stmnt1->execute();
$result = $stmnt1->get_result();
$stmnt1->close();

// Check if callsign was found
if ($result->num_rows === 0 or $allowDuplicates === TRUE) {
  // Insert new data
  try {
    $stmnt2 = $mysqli->prepare("INSERT INTO $dbtable (callsign, sequence, frequency, band, date, state, country, rstr, rsts, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmnt2->bind_param("sissssssss", $callsign, $sequence, $frequency, $band, $date, $state, $country, $rstr, $rsts, $notes);
    $stmnt2->execute();
    $result2 = $stmnt2->get_result();
    // debug messages
    //var_dump($result2);
    echo "New record created successfully";
    $stmnt2->close();

  } catch(Exception $e) {
    echo "An error occurred: " + $e;
  }
} else {
  echo "Duplicate callsign ($callsign) found.";
}

$mysqli->close();

}
 ?>
