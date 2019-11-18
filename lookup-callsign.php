<?php

include("config.php");

// Callsign from page REST GET
$callsign = $_GET['callsign'];

// Fetch site for json
$results = file_get_contents($callsignURI . $callsign);
$jsonDecode = json_decode($results);

// If a matching callsign found
if ($jsonDecode->status == "OK") {
  if ($jsonDecode->Licenses->totalRows == "1") {
    foreach ($jsonDecode->Licenses->License as $jsonCallsign) {
      echo "Name: " . $jsonCallsign->licName . "<br />";
      echo "Call Sign: " . $jsonCallsign->callsign . "<br />";
      echo "Service Type: " . $jsonCallsign->serviceDesc . "<br />";
      echo "Status: " . $jsonCallsign->statusDesc . "<br />";
      echo "Expiration: " . $jsonCallsign->expiredDate . "<br />";
      echo "FRN: " . $jsonCallsign->frn . "<br />";
      echo "License ID: " . $jsonCallsign->licenseID . "<br />";
      echo "<a href='$jsonCallsign->licDetailURL'>More Details</a> <br /><br />";
    }
    // If multiple matching callsigns are found
  } else {
    echo "<b>Multiple users found</b><br />";
    foreach ($jsonDecode->Licenses->License as $jsonCallsign) {
      echo "Name: " . $jsonCallsign->licName . "<br />";
      echo "Call Sign: " . $jsonCallsign->callsign . "<br />";
      echo "Service Type: " . $jsonCallsign->serviceDesc . "<br />";
      echo "Status: " . $jsonCallsign->statusDesc . "<br />";
      echo "Expiration: " . $jsonCallsign->expiredDate . "<br />";
      echo "FRN: " . $jsonCallsign->frn . "<br />";
      echo "License ID: " . $jsonCallsign->licenseID . "<br />";
      echo "<a href='$jsonCallsign->licDetailURL'>More Details</a> <br /><br />";
    }
  }
  // If none are found, or other error occurs
} else {
  foreach ($jsonDecode->Errors->Err as $error) {
    echo "Error Code: " . $error->code . "<br />";
    echo "Message: " . $error->msg;
  }
}

 ?>
