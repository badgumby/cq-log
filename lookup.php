<?php

include("config.php");

// Callsign from page REST POST/GET
if (isset($_POST['callsign'])) {
  $_GET['callsign'] = $_POST['callsign'];
}
$callsign = $_GET['callsign'];


?>

<html>
 <head>
   <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
   <link rel="stylesheet" href="styles/style.css">
   <title>Call Sign - <?php echo strtoupper($callsign); ?></title>
 </head>
<body class="lookupBody">

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
        <table>
          <tr>
            <td>
              <b>Name:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->licName; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Call Sign:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->callsign; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Service Type:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->serviceDesc; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Status:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->statusDesc; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Expiration:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->expiredDate; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>FRN:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->frn; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>License ID:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->licenseID; ?>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <a href="<?php echo $jsonCallsign->licDetailURL; ?>">More Details</a>
            </td>
          </tr>
        </table>
      </div>
      <?php
    }

    // If multiple matching callsigns are found
  } else {
    echo "<h2>Multiple users found</h2>";
    foreach ($jsonDecode->Licenses->License as $jsonCallsign) {
      ?>
      <div class="lookupDiv">
        <table>
          <tr>
            <td>
              <b>Name:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->licName; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Call Sign:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->callsign; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Service Type:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->serviceDesc; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Status:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->statusDesc; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>Expiration:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->expiredDate; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>FRN:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->frn; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>License ID:</b>
            </td>
            <td>
              <?php echo $jsonCallsign->licenseID; ?>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <a href="<?php echo $jsonCallsign->licDetailURL; ?>">More Details</a>
            </td>
          </tr>
        </table>
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
