<?php
require("inc/config.php");
require(MYSQL);

// south south data
$south_south="SELECT first_name, last_name FROM users WHERE state_id IN (3,6,9,10,12,33)";
$result_south_south= mysqli_query($dbc, $south_south) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($result_south_south) > 0) { // Available. 
$num_south_south=mysqli_num_rows($result_south_south);
}

// South West data
$south_west="SELECT first_name, last_name FROM users WHERE state_id IN (13,25,28,29,30,31)";
$result_south_west= mysqli_query($dbc, $south_west)or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($result_south_west) > 0) { // Available. 
$num_south_west=mysqli_num_rows($result_south_west);
}


// South East
$south_east="SELECT first_name, last_name FROM users WHERE state_id IN (1,4,11,14,17)";
$result_south_east= mysqli_query($dbc, $south_east)or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($result_south_east) > 0) { // Available. 
$num_south_east=mysqli_num_rows($result_south_east);
}

// North East data
$north_east="SELECT first_name, last_name FROM users WHERE state_id IN (2,5,8,16,35,36)";
$result_north_east= mysqli_query($dbc, $north_east)or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($result_north_east) > 0) { // Available. 
$num_north_east=mysqli_num_rows($result_north_east);
}


// North  Central
$north_central="SELECT first_name, last_name FROM users WHERE state_id IN (7,15,23,24,26,27,32)";
$result_north_central= mysqli_query($dbc, $north_central)or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($result_north_central) > 0) { // Available. 
$num_north_central=mysqli_num_rows($result_north_central);
}

// North West
$north_west="SELECT first_name, last_name FROM users WHERE state_id IN (18,19,20,21,22,34,37)";
$result_north_west= mysqli_query($dbc, $north_west)or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

if (mysqli_num_rows($result_north_west) > 0) { // Available. 
$num_north_west=mysqli_num_rows($result_north_west);
}



$data= array();
$data['south_south']   = $num_south_south ;
$data['south_west']    = $num_south_west;
$data['south_east']    = $num_south_east ;
$data['north_west']    = $num_north_west;
$data['north_central'] = $num_north_central ;
$data['north_east']    = $num_north_east;

$result_south_south->close();
$result_south_west->close();
$result_south_east->close();
$result_north_west->close();
$result_north_central->close();
$result_north_east->close();
mysqli_close($dbc);

print json_encode($data);
?>
