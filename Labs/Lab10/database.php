<!DOCTYPE html>

<!-- Fig. 19.16: database.php -->
<!-- Querying a database and displaying the results. -->
<html>
   <head>
      <meta charset = "utf-8">
      <title>Search Results</title>
   <style type = "text/css">
         body  { font-family: sans-serif;
                 background-color: lightyellow; } 
         table { background-color: lightblue; 
                 border-collapse: collapse; 
                 border: 1px solid gray; }
         td    { padding: 5px; }
         tr:nth-child(odd) {
                 background-color: white; }
      </style>
   </head>

   <body>
      <?php
         require 'db.inc';
         $select = $_POST["select"]; // creates variable $select

         // build SELECT query
         $query = "SELECT " . $select . " FROM STUDENTS";

         // Connect to MySQL
         if ( !( $con = mysqli_connect( "localhost",
            "s_gforsberg", "U&!hNDz!H#D#VXB33ynYb4e5^5bMbejRNHR" ) ) )                      
            die( "Could not connect to database </body></html>" );
   
         // open Products database
         if ( !mysqli_select_db( $con, "s_gforsberg") )
            die( "Could not open the database </body></html>" );

         // query Products database
         if ( !( $result = mysqli_query( $con, $query ) ) ) 
         {
            print( "<p>Could not execute query!</p>" );
            die( mysqli_error($con) . "</body></html>" );
         } // end if

         mysqli_close( $database );
      ?><!-- end PHP script -->
      <table>
         <caption>Results of "SELECT <?php print( "$select" ) ?> 
            FROM wine"</caption>
         <?php
            // fetch each record in result set
            while ( $row = mysqli_fetch_row( $result ) )
            {
               // build table to display results
               print( "<tr>" );

               foreach ( $row as $value ) 
                  print( "<td>$value</td>" );

               print( "</tr>" );
            } // end while
         ?><!-- end PHP script -->
      </table>
      <p>Your search yielded 
         <?php print( mysqli_num_rows( $result ) ) ?> results.</p>
      <p>Please email comments to <a href = "mailto:deitel@deitel.com">
            Deitel and Associates, Inc.</a></p>
   </body>
</html>

<!--
**************************************************************************
* (C) Copyright 1992-2008 by Deitel & Associates, Inc. and               *
* Pearson Education, Inc. All Rights Reserved.                           *
*                                                                        *
* DISCLAIMER: The authors and publisher of this book have used their     *
* best efforts in preparing the book. These efforts include the          *
* development, research, and testing of the theories and programs        *
* to determine their effectiveness. The authors and publisher make       *
* no warranty of any kind, expressed or implied, with regard to these    *
* programs or to the documentation contained in these books. The authors *
* and publisher shall not be liable in any event for incidental or       *
* consequential damages in connection with, or arising out of, the       *
* furnishing, performance, or use of these programs.                     *
**************************************************************************
-->