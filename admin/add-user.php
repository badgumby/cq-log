<?php

include("../config.php");

$master = "../../files/master.json";
$masterRawJson = file_get_contents($master);
$masterInput = json_decode($masterRawJson);

$masterpass = $masterInput->masterpass;
$mpSubmit = $_POST['masterpass'];

?>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/style.css">
  <title>CQ Logbook - Add User</title>
</head>
<body>
  <div class="adminDiv">
    <h3>CQ Log - User Add Status</h3>
    <table>
<?php
// Check if master password is valid
if($mpSubmit !== $masterpass){
  ?>
  <tr>
    <td>
      Incorrect admin password
    </td>
  </tr>
  <?php
// Post the stuff
} else {
  ?>
  <tr>
    <td>
      Admin authentication successful
    </td>
  </tr>
  <?php
  // Grab posts
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Create connection
  $mysqli = new mysqli($servername, $dbuser, $dbpass, $dbname);
  // Check connection
  if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
  }

  // Verfiy user does not already exist
  $stmnt1 = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
  $stmnt1->bind_param("s", $username);
  $stmnt1->execute();
  $result = $stmnt1->get_result();
  $stmnt1->close();

  // Check if username was found
  if ($result->num_rows === 0) {
    // Insert new data
    try {
      $stmnt2 = $mysqli->prepare("INSERT INTO users (username, pswd) VALUES (?, SHA1(?))");
      $stmnt2->bind_param("ss", $username, $password);
      $stmnt2->execute();
      $result2 = $stmnt2->get_result();
      // debug messages
      //var_dump($result2);
      ?>
      <tr>
        <td>
          User created successfully
        </td>
      </tr>
      <?php
      $stmnt2->close();

      $stmnt3 = $mysqli->prepare("CREATE TABLE `$username` (callsign TEXT, sequence int(11), band TEXT NULL, date datetime, frequency TEXT NULL, state TEXT NULL, country TEXT NULL, notes TEXT NULL, rstr TEXT NULL, rsts TEXT NULL, ident int(10) NOT NULL AUTO_INCREMENT, PRIMARY KEY (ident));");
      $stmnt3->execute();
      $result3 = $stmnt3->get_result();
      // debug messages
      //var_dump($result2);
      ?>
      <tr>
        <td>
          Default user table created successfully
        </td>
      </tr>
      <?php
      $stmnt3->close();

    } catch(Exception $e) {
      ?>
      <tr>
        <td>
          <?php echo "An error occurred: " + $e; ?>
        </td>
      </tr>
      <?php
    }
  } else {
    ?>
    <tr>
      <td>
        Duplicate user (<?php echo $username; ?>) found
      </td>
    </tr>
    <?php
  }

  $mysqli->close();
  //INSERT INTO users (username, pswd) VALUES ('badgumby', SHA1('password'));

}
 ?>
    <tr>
      <td>
        <a href="add-user-form.php">Add another user</a>
      </td>
    </tr>
    <tr>
      <td>
        <a href="../index.php">Back to main page</a>
      </td>
    </tr>
    </table>
   </div>
</body>
</html>
