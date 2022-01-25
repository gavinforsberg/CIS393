<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

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
        .nav-menu > li > a::before {
                content: "";
	    }
	    #main_nav {
		        display: none;
	    }
</style>
</head>

<body>
<nav id = "main_nav">
<ul>
	<li><a href="store.html"></a></li>
</ul>
</nav>

<?php
        $type = $_POST["type"];
        $year = $_POST["year"];
        $email = $_POST["Email"];
		
        // Build SELECT query
        // $query = "SELECT DISTINCT w.wine_id, w.wine_name, w.wine_type, w.year, w.winery_id, w.description FROM wine w, winery wi, wine_type wt, grape_variety g, wine_variety wv WHERE w.year = '{$year}' AND w.winery_id = wi.winery_id";
        // $query = "SELECT DISTINCT w.wine_name, wt.wine_type w.year FROM wine w WHERE wine_type wt, w.year = '{$year}'";
        // $query = "SELECT wine_name, year FROM wine";
        //$query="SELECT DISTINCT w.wine_name, w.year, wt.wine_type FROM wine w, wine_type wt WHERE w.year = '{$year}'";
        //$query="SELECT DISTINCT w.wine_name, w.year FROM wine w WHERE w.year = '{$year}'";

        $query="SELECT DISTINCT w.wine_name, w.year, wt.wine_type FROM wine w, wine_type wt WHERE w.year >= '$year'";

        // Add wine type restriction if they've selected anything
   		// except "All" 
   		if ($type != "All")
      	    $query .= " AND wt.wine_type = '{$type}'";
           
        // Connect to MySQL
        if ( !( $con = mysqli_connect( "localhost", "s_gforsberg", "2QpCaxZq" ) ) )
            die( "<p>Could not connect to database</p></body></html>" );

        // open MailingList database
        if ( !mysqli_select_db( $con, "s_gforsberg" ) )
          die( "<p>Could not open MailingList database</p></body></html>" );

        // query database
        if ( !( $result = mysqli_query( $con, $query ) ) ) 
        {
            print( "<p>Could not execute query!</p>" );
            echo("Error: " . mysqli_error($con) );
        } // end if
     ?><!-- end PHP script -->

    <h1>Wine Data</h1>
    <table>
      <tr>
        <th>Name &nbsp</th>
        <th>Year &nbsp</th>
        <th>Type &nbsp</th>
      </tr>
           
    <?php

        // fetch each record in result set
        $emailObject = "<table border = '1'>";
        $emailObject .="<tr>";
        $emailObject .="<th>Wine Name</th>";
        $emailObject .="<th>Year</th>";
        $emailObject .="<th>Wine Type</th>";

        // fetch each record in result set
        for ( $counter = 0; $row = mysqli_fetch_row( $result );
            ++$counter )
        {
            // build table to display results
            print( "<tr>" );
            $emailObject .= "<tr>";

            foreach ( $row as $key => $value ) 
                print( "<td>$value</td><p></p>" );
            foreach ( $row as $key => $value )
                $emailObject .= "<td>$value</td>";

            print( "</tr>" );
            $emailObject .= "</tr><p></p>";
        } 
			
		$email = $_POST['email'];
		// To send HTML mail, the Content-type header must be set
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
		// Create email headers
		$headers .= "From: WineSellers@gmail.com\n";

		$to = "$email";
        $subject = "Results\n";
		
		strip_tags($emailObject);
        str_pad($body, 15," ", STR_PAD_BOTH);

        $body .= $emailObject;

        if (mail($to, $subject, $body, $headers)) {
            echo("<p>Message successfully sent!</p>");
        } else {
            echo("<p>Message delivery failed.</p>");
        }

        mysqli_close( $database );
        ?> <!--end PHP script -->
    </table>

<?php
    define("SEVENDAYS", time() + (60 * 60 * 24 * 7));
    setcookie("Email", $_POST["email"], time() + SEVENDAYS);
?>

<p>The cookie has been set with the following data: </p> 
<p>Email: <?php print($email) ?></p>
<p>Click <a href = "readCookie.php">here</a> to read the saved cookie.</p>


</body>
</html>