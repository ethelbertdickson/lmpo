<?php #  mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.
// Author: JOShua Ekpe
// September 29, 2018

// Set the database access information as constants:
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'lmpocrs_supporters');
DEFINE ('DB_USER', 'lmpocrs_supporteruser');
DEFINE ('DB_PASSWORD', ',2&89rg8VA$T');


// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

