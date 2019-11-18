<?php

include("config.php");

// Callsign from page REST GET
$callsign = $_GET['callsign'];

?>

<html>
 <head>
   <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
   <link rel="stylesheet" href="styles/style.css">
   <title>Call Sign - <?php echo strtoupper($callsign); ?></title>
 </head>
<body>

<?php

// Fetch site for json
$results = file_get_contents($callsignURI . $callsign);
$jsonDecode = json_decode($results);

// If a matching callsign found
if ($jsonDecode->status == "OK") {
  if ($jsonDecode->Licenses->totalRows == "1") {
    foreach ($jsonDecode->Licenses->License as $jsonCallsign) {
      echo "<b>Name:</b> " . $jsonCallsign->licName . "<br />";
      echo "<b>Call Sign:</b> " . $jsonCallsign->callsign . "<br />";
      echo "<b>Service Type:</b> " . $jsonCallsign->serviceDesc . "<br />";
      echo "<b>Status:</b> " . $jsonCallsign->statusDesc . "<br />";
      echo "<b>Expiration:</b> " . $jsonCallsign->expiredDate . "<br />";
      echo "<b>FRN:</b> " . $jsonCallsign->frn . "<br />";
      echo "<b>License ID:</b> " . $jsonCallsign->licenseID . "<br />";
      echo "<a href='$jsonCallsign->licDetailURL'>More Details</a> <br /><br />";
    }
    // If multiple matching callsigns are found
  } else {
    echo "<b>Multiple users found</b><br />";
    foreach ($jsonDecode->Licenses->License as $jsonCallsign) {
      echo "<b>Name:</b> " . $jsonCallsign->licName . "<br />";
      echo "<b>Call Sign:</b> " . $jsonCallsign->callsign . "<br />";
      echo "<b>Service Type:</b> " . $jsonCallsign->serviceDesc . "<br />";
      echo "<b>Status:</b> " . $jsonCallsign->statusDesc . "<br />";
      echo "<b>Expiration:</b> " . $jsonCallsign->expiredDate . "<br />";
      echo "<b>FRN:</b> " . $jsonCallsign->frn . "<br />";
      echo "<b>License ID:</b> " . $jsonCallsign->licenseID . "<br />";
      echo "<a href='$jsonCallsign->licDetailURL'>More Details</a> <br /><br />";
    }
  }
  // If none are found, or other error occurs
} else {
  foreach ($jsonDecode->Errors->Err as $error) {
    echo "<b>Error Code:</b> " . $error->code . "<br />";
    echo "<b>Message:</b> " . $error->msg;
  }
}

?>

</body>
</html>
