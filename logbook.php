<?php

include("config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Used for posting data
$local = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <section>
    <div class="header">
      <h3>CQ Logbook</h3>
    </div>
<div class="middle">
  <iframe class="topiFrame" id="topiFrame" src="log.php"></iframe>
</div>
<div class="footer">
  <div id="responseDiv" class="responseDiv">
    <h3>Status</h3>
    <div id="responseMsg">

    </div>
  </div>
  <hr class="bottomHR"/>
  <div class="entryDiv">
  <form class="entryForm" action="add-entry.php" id="entryForm" method="post">
    <table>
      <tr>
        <td>
          Callsign
        </td>
        <td>
          <input type="text" id="callsign" name="callsign" required/>
        </td>
        <!--      </tr>
              <tr> -->
        <td>
          Sequence
        </td>
        <td>
          <input type="number" id="sequence" name="sequence" required/>
        </td>
<!--      </tr>
      <tr> -->
        <td>
          Frequency (MHz)
        </td>
        <td>
          <input type="text" id="frequency" name="frequency" onfocus="checkBand();"/>
        </td>
        <!--      </tr>
              <tr> -->
        <td>
          Band
        </td>
        <td>
          <select name="band" id="band" size="1" required="required" onfocus="checkBand();">
            <option value="160m">160m</option>
            <option value="80m">80m</option>
            <option value="40m">40m</option>
            <option value="30m">30m</option>
            <option value="20m">20m</option>
            <option value="17m">17m</option>
            <option value="15m">15m</option>
            <option value="12m">12m</option>
            <option value="10m">10m</option>
            <option value="6m">6m</option>
            <option value="2m">2m</option>
            <option value="70cm">70cm</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          Location
        </td>
        <td>
          <input type="text" id="location" name="location" required/>
        </td>
        <!--      </tr>
              <tr> -->
        <td>
          Date
        </td>
        <td>
          <input type="text" id="date" name="date" onfocus="getDate();" required/>
        </td>
        <!--      </tr>
              <tr> -->
        <td>
          Notes
        </td>
        <td>
          <input type="text" id="notes" name="notes"/>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;">
          <input type="checkbox" name="allowDuplicates" id="allowDuplicates" /> Allow Duplicate entries
        </td>
        <!--      </tr>
              <tr> -->
        <td colspan="2" style="text-align: center;">
           <input type="button" onclick="form.submit()" value="Submit">
        </td>
      </tr>
    </table>
  </form>
  </div>
</div>
<script type="text/javascript">
  function checkBand() {
    var x = document.getElementById('frequency').value;
    // 160m
    if (x >= 1.8 && x <= 2.0) {
      document.getElementById('band').selectedIndex = "0";
    }
    // 80m
    if (x >= 3.5 && x <= 4.0) {
      document.getElementById('band').selectedIndex = "1";
    }
    // 40m
    if (x >= 7.0 && x <= 7.3) {
      document.getElementById('band').selectedIndex = "2";
    }
    // 30m
    if (x >= 10.1 && x <= 10.15) {
      document.getElementById('band').selectedIndex = "3";
    }
    // 20m
    if (x >= 14.0 && x <= 14.350) {
      document.getElementById('band').selectedIndex = "4";
    }
    // 17m
    if (x >= 18.068 && x <= 18.168) {
      document.getElementById('band').selectedIndex = "5";
    }
    // 15m
    if (x >= 21.0 && x <= 21.450) {
      document.getElementById('band').selectedIndex = "6";
    }
    // 12m
    if (x >= 24.890 && x <= 24.990) {
      document.getElementById('band').selectedIndex = "7";
    }
    // 10m
    if (x >= 28.0 && x <= 29.70) {
      document.getElementById('band').selectedIndex = "8";
    }
    // 6m
    if (x >= 50 && x <= 54) {
      document.getElementById('band').selectedIndex = "9";
    }
    // 2m
    if (x >= 144 && x <= 148) {
      document.getElementById('band').selectedIndex = "10";
    }
    // 70cm
    if (x >= 430 && x <= 440) {
      document.getElementById('band').selectedIndex = "11";
    }
  }

  function addZero(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

  function getDate(){
    var now = new Date();
    var mo = addZero(now.getMonth() + 1);
    var d = addZero(now.getDate());
    var y = addZero(now.getFullYear());
    var h = addZero(now.getHours());
    var m = addZero(now.getMinutes());
    var s = addZero(now.getSeconds());
    var datestring = y + "-" + mo + "-" + d + " " + h + ":" + m + ":" + s;
    document.getElementById("date").value = datestring;
  }
  getDate();

  var form = document.getElementById('entryForm');

  // You could use the FormData API if the browser supports it.
  // Below is somewhat alternate and should be improved to support more form element types.
  function urlEncodeFormData(form) {
    var i, e, data = [];
    for (i = 0; i < form.elements.length; i++) {
      e = form.elements[i];
      if (e.type !== 'button' && e.type !== 'submit' && e.type !== 'checkbox') {
        data.push(encodeURIComponent(e.id) + '=' + encodeURIComponent(e.value));
      }
      if (e.type == 'checkbox' && e.checked == true)
        data.push(encodeURIComponent(e.id) + '=' + encodeURIComponent(e.value));
    }
    return data.join('&');
  }

  function onSubmit(event) {
      if (event) { event.preventDefault(); }
      console.log('submitting');
      postFormData(form); // <-------- see below
    }
    // prevent when a submit button is clicked
    form.addEventListener('submit', onSubmit, false);
    // prevent submit() calls by overwriting the method
    form.submit = onSubmit;

    function postFormData(form) {
      var xhr = new XMLHttpRequest(),
        formData = urlEncodeFormData(form); // see below

        // open
        xhr.open('POST', '<?php echo $local; ?>/add-entry.php', true);
        // set XHR headers
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // watch for state changes
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            // This is where you show a success message to the user
          }
        };
        // open and send the post request
        xhr.send(formData);

        // refresh iframe
        document.getElementById('topiFrame').contentWindow.location.reload();

        // Log output to div
        let console = {};

            // Getting div to insert logs
            let logger = document.getElementById("responseMsg");
            // Clear current log
            logger.innerHTML = " ";
            // Adding log method from our console object
            console.log = text =>
            {
                let element = document.createElement("div");
                let txt = document.createTextNode(text);

                //element.appendChild(txt);
                logger.appendChild(txt);
            }

            // testing


      }
</script>
</section>
</body>
</html>
