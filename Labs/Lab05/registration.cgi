#!/usr/bin/perl -wT

use strict;
use CGI;

my $q = new CGI;
print $q->header( "text/html" );

print "These are the parameters I received:<P>";

my( $name, $value );

foreach $name ( $q->param ) {
    print "$name:";
    foreach $value ( $q->param( $name ) ) {
        print "  $value<br>";
    }
}

