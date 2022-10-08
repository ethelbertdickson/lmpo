<?php
require("inc/config.php");
require(MYSQL);



$q="SELECT    age_group  FROM users WHERE age_group = 1 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g1 = mysqli_num_rows($r);
}


$q="SELECT    age_group  FROM users WHERE age_group = 2 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g2 = mysqli_num_rows($r);
}


$q="SELECT    age_group  FROM users WHERE age_group = 3 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g3 = mysqli_num_rows($r);
}


$q="SELECT    age_group  FROM users WHERE age_group = 4 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g4 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 5 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g5 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 6 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g6 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 7 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g7 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 8 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g8 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 9 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g9 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 10 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g10 = mysqli_num_rows($r);
}

$q="SELECT    age_group  FROM users WHERE age_group = 11 ";
$r= mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($r) >= 0){
 $g11 = mysqli_num_rows($r);
}
    
$age = array();
  $age['_1st'] = $g1;
  $age['_2nd'] = $g2;
  $age['_3rd'] = $g3;
  $age['_4th'] = $g4;
  $age['_5th'] = $g5;
  $age['_6th'] = $g6;
  $age['_7th'] = $g7;
  $age['_8th'] = $g8;
  $age['_9th'] = $g9;
  $age['_10th'] = $g10;
  $age['_11th']   = $g11;

    





$r->close();
mysqli_close($dbc);
print json_encode($age);
?>
