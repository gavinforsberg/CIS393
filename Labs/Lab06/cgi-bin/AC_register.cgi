#!/usr/bin/perl -wT
use strict; 
use CGI; 

my $obj = new CGI;
my $datastring ="";

# read information from form
my $username = $obj->param( "username" );
my $email = $obj->param( "email" );
my $studID = $obj->param( "studentID" );
my @avail = $obj->param( "availability" );
my $avail2="";
foreach my $availop (@avail) {
   $avail2 .= "$availop ";
}

my $year = $obj->param( "year" );

my $livson = $obj->param( "livson" );
my @activity = $obj->param( "activity" );
my $activity2="";
foreach my $act (@activity) {
   $activity2 .= "$act ";
}
my $comments = $obj->param( "comments" );

# Save the data into a text file

$datastring = "Saved Data\n\nUser name: $username\nEmail: $email\nStudent ID: $studID\nAvailability: $avail2\nGraduation Year: $year\nLives: $livson\nActivites: $activity2\nComments: $comments\n\n";

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
	$obj->p("User name:  $username"),
	$obj->p("Email:  $email"),
	$obj->p("Student ID:  $studID"),
	$obj->p("Availability:  $avail2"),
	$obj->p("Graduation Year: $year"),	
	$obj->p("Lives:  $livson"),	
	$obj->p("Activities:  $activity2"),	
	$obj->p("Comments: $comments"),
	$obj->end_html;
	
print("<meta http-equiv='refresh' content='2;url=../BUAC.html' />");
