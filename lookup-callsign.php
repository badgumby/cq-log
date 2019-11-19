<?php


 ?>

 <html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <title>Call Sign Lookup</title>
  </head>
 <body class="lookupBody">

   <div class="lookupDiv">
     <form method="post" name="fccsearch" id="fccsearch" action="lookup.php">
     <table>
       <tr>
         <td>
           FCC Call Sign/FRN/Name
         </td>
       </tr>
       <tr>
         <td>
           <input type="text" id="callsign" name="callsign" required/>
         </td>
       </tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Search" />
         </td>
       </tr>
     </table>
     </form>
   </div>

 </body>
</html>
