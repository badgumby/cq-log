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
      ?>
      <div class="lookupDiv">
      <b>Name:</b> <?php echo $jsonCallsign->licName; ?> <br />
      <b>Call Sign:</b> <?php echo $jsonCallsign->callsign; ?> <br />
      <b>Service Type:</b> <?php echo $jsonCallsign->serviceDesc; ?> <br />
      <b>Status:</b> <?php echo $jsonCallsign->statusDesc; ?> <br />
      <b>Expiration:</b> <?php echo $jsonCallsign->expiredDate; ?> <br />
      <b>FRN:</b> <?php echo $jsonCallsign->frn; ?> <br />
      <b>License ID:</b> <?php echo $jsonCallsign->licenseID; ?> <br />
      <a href="<?php echo $jsonCallsign->licDetailURL; ?>">More Details</a><br />
      </div>
      <?php
    }

    // If multiple matching callsigns are found
  } else {
    echo "<b>Multiple users found</b><br />";
    foreach ($jsonDecode->Licenses->License as $jsonCallsign) {
      ?>
      <div class="lookupDiv">
      <b>Name:</b> <?php echo $jsonCallsign->licName; ?> <br />
      <b>Call Sign:</b> <?php echo $jsonCallsign->callsign; ?> <br />
      <b>Service Type:</b> <?php echo $jsonCallsign->serviceDesc; ?> <br />
      <b>Status:</b> <?php echo $jsonCallsign->statusDesc; ?> <br />
      <b>Expiration:</b> <?php echo $jsonCallsign->expiredDate; ?> <br />
      <b>FRN:</b> <?php echo $jsonCallsign->frn; ?> <br />
      <b>License ID:</b> <?php echo $jsonCallsign->licenseID; ?> <br />
      <a href="<?php echo $jsonCallsign->licDetailURL; ?>">More Details</a> <br />
      </div>
      <?php
    }
  }
  // If none are found, or other error occurs
} else {
  foreach ($jsonDecode->Errors->Err as $error) {
    ?>
    <div class="lookupDiv">
    <?php
    echo "<b>Error Code:</b> " . $error->code . "<br />";
    echo "<b>Message:</b> " . $error->msg;
    ?>
    </div>
    <?php
  }

}

?>

</body>
</html>
