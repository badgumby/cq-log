<?php



 ?>


 <html>
 <head>
   <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../styles/style.css">
   <title>CQ Logbook - Add User</title>
 </head>
 <body>
   <div class="adminDiv">
     <h3>CQ Log - Add User</h3>
     <form class="entryForm" id="add-user" name="add-user" action="add-user.php" method="post">
       <table>
         <tr>
           <td>
             Username
           </td>
           <td>
             <input type="text" name="username" id="password" required />
           </td>
         </tr>
         <tr>
           <td>
             Password
           </td>
           <td>
             <input type="password" name="password" id="password" required  />
           </td>
         </tr>
         <tr>
           <td>
             Admin Password (Required to submit new user)
           </td>
           <td>
             <input type="password" name="masterpass" id="masterpass" required  />
           </td>
         </tr>
         <tr>
           <td colspan="2">
             <input type="submit" value="Submit" />
           </td>
         </tr>
       </table>
     </form>
   </div>
 </body>
 </html>
