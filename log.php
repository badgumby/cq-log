<?php

include("config.php");

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

// Post the stuff
} else {

// Create connection
$mysqli = new mysqli($servername, $dbuser, $dbpass, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$dbtable = $_SESSION['username'];

?>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php

$sql = "SELECT callsign, sequence, band, date, frequency, state, country, rstr, rsts, notes, ident FROM $dbtable ORDER BY ident DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // Build table
  ?>
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
        State
      </th>
      <th>
        Country
      </th>
      <th>
        RST-R
      </th>
      <th>
        RST-S
      </th>
      <th>
        Date/Time
      </th>
      <th>
        Notes
      </th>
    </tr>
  <?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>
      <tr>
        <td>
          <?php echo $row["ident"]; ?>
        </td>
        <td>
          <a href="lookup-callsign.php?callsign=<?php echo $row["callsign"]; ?>" target="_blank" onClick="window.open('lookup-callsign.php?callsign=<?php echo $row["callsign"]; ?>','Callsign Lookup','resizable,height=400,width=300'); return false;"><?php echo $row["callsign"]; ?></a>
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
          <?php echo $row["state"]; ?>
        </td>
        <td>
          <?php echo $row["country"]; ?>
        </td>
        <td>
          <?php echo $row["rstr"]; ?>
        </td>
        <td>
          <?php echo $row["rsts"]; ?>
        </td>
        <td>
          <?php echo $row["date"]; ?>
        </td>
        <td>
          <?php echo $row["notes"]; ?>
        </td>
      </tr>
    </table>
      <?php
    }
} else {
    echo "You currenlty have 0 contacts. As soon as you submit one, it will appear in this list! ";
}
$mysqli->close();
}
?>
