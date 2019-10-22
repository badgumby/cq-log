<?php
// Initialize the session
session_start();

 ?>
<html>
 <head>
   <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
   <link rel="stylesheet" href="styles/style.css">
   <title>CQ Log</title>
 </head>
 <body>
   <div class="loginDiv">
     <form name="login" id="login" class="" method="post" action="logbook.php">
       <table>
         <tr>
           <td>
             Username
           </td>
           <td>
             <input type="text" name="username" id="username" required />
           </td>
         </tr>
         <tr>
           <td>
             Password
           </td>
           <td>
             <input type="password" name="password" id="password" required />
           </td>
         </tr>
         <tr>
           <td colspan="2">
             <input type="submit" name="submit" value="Submit" />
           </td>
         </tr>
      </table>
     </form>
   </div>
 </body>
</html>
