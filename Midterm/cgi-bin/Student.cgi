#!/usr/bin/perl -wT
use strict; 
use CGI; 

my $obj = new CGI;
my $datastring ="";

# read information from form

my $email = $obj->param( "email" );

my $school = $obj->param( "school" );

# Save the data into a text file

$datastring = "Saved Data\n\nEmail: $email\n\n";

open(OUTDATA, ">>data.txt") or die "Error in opening file data.txt";
print OUTDATA $datastring;
close(OUTDATA); 

#Send the info back
print $obj->header( "text/html" ),
	$obj->start_html(
        	-title    => "Form Data",			
		-topmargin =>"0"
        ),	
	$obj->h1("Submitted Form Data Detail"),
	$obj->p("College:  $school"),
	$obj->p("Email:  $email"),
	$obj->end_html;
	
print("<meta http-equiv='refresh' content='2;url=../BUAC.html' />");
