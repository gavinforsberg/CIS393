#!/usr/bin/perl -wT
use strict; 
use CGI; 

my $obj = new CGI;
my $datastring ="";

# read information from form
my $username = $obj->param( "username" );
my @toppings = $obj->param( "toppings" );
my $toppings2="";
foreach my $topping (@toppings) {
   $toppings2 .= "$topping ";
}
my $bread = $obj->param( "bread" );
my $credit_card = $obj->param( "credit_card" );
my @activity = $obj->param( "activity" );
my $activity2="";
foreach my $act (@activity) {
   $activity2 .= "$act ";
}
my $comments = $obj->param( "comments" );

# Save the data into a text file

$datastring = "Saved Data\n\nUser name: $username:\nToppings: $toppings2\nBread: $bread\nCredit Card: $credit_card\nActivites: $activity2\nComments: $comments\n\n";
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
	$obj->p("Toppings:  $toppings2"),
	$obj->p("Bread: $bread"),	
	$obj->p("Credit Card:  $credit_card"),	
	$obj->p("Activities:  $activity2"),	
	$obj->p("Comments: $comments"),
	$obj->end_html;
