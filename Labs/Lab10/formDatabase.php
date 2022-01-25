<!DOCTYPE html>

<!-- Fig. 19.22: formDatabase.php -->
<!-- Displaying the MailingList database. -->
<html>
   <head>
      <meta charset = "utf-8">
      <title>Search Results</title>
      <style type = "text/css">
         table  { background-color: lightblue; 
                  border: 1px solid gray; 
                  border-collapse: collapse; }
         th, td { padding: 5px; border: 1px solid gray; }
         tr:nth-child(even) { background-color: white; }
         tr:first-child { background-color: lightgreen; }
      </style>
   </head>
   <body>
      <?php
         // build SELECT query
         $query = "SELECT * FROM wine";
        
         // Connect to MySQL
         if ( !( $con = mysqli_connect( "localhost",  
            "s_gforsberg", "2QpCaxZq" ) ) )
            die( "<p>Could not connect to database</p></body></html>" );
   
         // open MailingList database
         if ( !mysqli_select_db( $con, "s_gforsberg" ) )
            die( "<p>Could not open MailingList database</p>
               </body></html>" );

         // query MailingList database
         if ( !( $result = mysqli_query( $con, $query ) ) ) 
         {
            print( "<p>Could not execute query!</p>" );
            echo("Error: " . mysqli_error($con) );
         } // end if
      ?><!-- end PHP script -->

      <h1>Wine</h1>
      <table>
         <caption>Wine Data</caption>
         <tr>
            <th>ID</th>
            <th>Wine Name </th>
            <th>Type</th>
            <th>Year</th>
            <th>WineryID</th>
            <th>Description</th>
        </tr>
         
         <?php
            // fetch each record in result set
            for ( $counter = 0; $row = mysqli_fetch_row( $result );
               ++$counter )
            {
               // build table to display results
               print( "<tr>" );

               foreach ( $row as $key => $value ) 
                  print( "<td>$value</td>" );

               print( "</tr>" );
            } // end for

            mysqli_close( $database );
         ?><!-- end PHP script -->
      </table>
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