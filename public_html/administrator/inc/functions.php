<?php
//create function to add new user to the system
 function Register_New_User(){
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
    require(MYSQL);
    
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$fn = $ln = $e = $p = $ul= FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	} else {
		echo '<script> swal("Oops!", "Please enter your first name!", "error"';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	} else {
		echo '<script> swal("Oops!", "Please enter your last name!", "error"';
	}
	
	// Check for an email address:
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<script> swal("Oops!", "Please enter a valid email address!", "error"';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{6,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<script> swal("Oops!", "Your password did not match the confirmed password!", "error");</script>';
		}
	} else {
		echo '<script> swal("Oops!", "Please enter a valid password! <br/>Minimum of six characters is required.", "error");</script>';
	}

	// Check for a Phone Number:
	if ($trimmed['country']){
		$country = mysqli_real_escape_string ($dbc, $trimmed['country']);
	} else {
		echo '<script> swal("Oops!", "Please select your country!", "error"';
	}
	
	
	
	  //if everything is ok register the user
	if ($fn && $ln && $e && $p && $country  ) { // If everything's OK...

		// Make sure the email address has not been used by another user:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { // Available.
		
					// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name,  country_id, created_at, updated_at) VALUES ('$e', SHA1('$p'), '$fn', '$ln',  '$country',  NOW(), NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			
				
		// Finish the page:
		echo '<script>	swal.fire("Good job!", "Registration Successful!", "success");
		  </script>';
		  echo'<div class="container col-md-4" align ="center" style="padding-top:20px;" >';
		  echo '<a class="btn link_btn btn-lg btn-block" href="login.php">LOG IN</a>';
		  echo'</div>';
				
			} else { // If it did not run OK.
				echo '<script> swal("Oops!", "You could not be registered due to a system error. We apologize for any inconvenience", "error");</script>';
			}
			
		
		} else { // The email address is not available.
			echo '<script> swal.fire("Oops!", "That email address has already been registered!", "error");
			</script>';
			echo'<div class="container col-md-4" align ="center" style="padding-top:20px;" >';
			echo '<a class="btn link_btn btn-lg" href="forgot_password.php">RESET PASSWORD</a>';
			echo '</div>';
				include ('footer.php'); // Include the HTML footer.
				exit(); // Stop the page.
				
		}
		
	} else { // If one of the data tests failed.
		echo '<script> swal.fire("Oops!", "Something went wrong, please try again", "error");</script>';
	}

	mysqli_close($dbc);

} //
 }// End Function Register_new_user
 
 
 // view users functions
 function view_users(){
	//need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
		case 'ul':
		$order_by = 'user_level ASC';
		break;
	case 'rd':
		$order_by = 'created_at ASC';
		break;
	default:
		$order_by = 'created_at ASC';
		$sort = 'rd';
		break;
}



	// Define the query to determine the total number of  registered users:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users  ";		
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
// do nothing
}
	
// Define the query:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id,active FROM users ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo ' <h3 style ="color:#02623E">All Registered Users</h3>';
echo "<p style='color:#02623E;'><strong>There are currently $num registered Users on the portal</strong></p>\n <hr>";
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
	<td style="color:#f90" align="left"><b>Edit</b></td>
	<td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_users.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="view_users.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="view_users.php?sort=ul">User Level</a></b></td>
	<td align="left"><b><a href="view_users.php?sort=ac">Active</a></b></td>
	<td align="left"><b><a href="view_users.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['user_level'] . '</td>
		<td align="left">' . $row['active'] . '</td>
		<td align="left">' . $row['dr'] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="submit2"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="submit2"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
 }//end view users function
 
 //start view teachers functions
 function view_teachers(){
	 //need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users WHERE user_level ='2'";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
		case 'ul':
		$order_by = 'user_level ASC';
		break;
	case 'rd':
		$order_by = 'created_at ASC';
		break;
	default:
		$order_by = 'created_at ASC';
		$sort = 'rd';
		break;
}


	// Define the query to determine the total number of  registered teachers:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level ='2'";		
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
// do nothing
}
	
// Define the query:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level ='2' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo ' <h3 style ="color:#02623E">All Registered Teachers</h3>';
// Print how many users there are:
	echo "<p style='color:#02623E;'><strong>There are currently $num registered Teachers on the portal</strong></p>\n <hr>";
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
	<td style="color:#f90" align="left"><b>Edit</b></td>
	<td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_teachers.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="view_teachers.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="view_teachers.php?sort=ul">User Level</a></b></td>
	<td align="left"><b><a href="view_teachers.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['user_level'] . '</td>
		<td align="left">' . $row['dr'] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_teachers.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input type="button" value="Previoust" class="submit"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_teachers.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {

			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_teachers.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"> <input type="button" value="Next" class="submit"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
 }//End view teachers function
 
//start view teachers functions
 function view_teachers2(){
	 //need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users WHERE user_level ='2'";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
		case 'ul':
		$order_by = 'user_level ASC';
		break;
	case 'rd':
		$order_by = 'created_at ASC';
		break;
	default:
		$order_by = 'created_at ASC';
		$sort = 'rd';
		break;
}


	// Define the query to determine the total number of  registered teachers:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level ='2'";		
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
// do nothing
}
	
// Define the query:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level ='2' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo ' <h3 style ="color:#02623E">All Registered Teachers</h3>';
// Print how many users there are:
	echo "<p style='color:#02623E;'><strong>There are currently $num registered Teachers on the portal</strong></p>\n <hr>";
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
	<td style="color:#f90" align="left"><b>Edit</b></td>
	<td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_teachers.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="view_teachers.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="view_teachers.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="#">Edit</a></td>
		<td align="left"><a href="#">Delete</a></td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['dr'] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_teachers2.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input type="button" value="Previoust" class="submit"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_teachers2.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {

			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_teachers2.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"> <input type="button" value="Next" class="submit"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
 }//End view teachers function
 


 //start view students
 function view_students(){
	 //need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users WHERE user_level ='1'";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
		case 'ul':
		$order_by = 'user_level ASC';
		break;
	case 'rd':
		$order_by = 'created_at ASC';
		break;
	default:
		$order_by = 'created_at ASC';
		$sort = 'rd';
		break;
}

// Define the query to determine the total number of  registered students:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level ='1'";		
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
// do nothing
}

	
// Define the query:
$q = "SELECT last_name, first_name, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE user_level ='1' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo ' <h3 style ="color:#02623E">All Registered Students</h3>';
	// Print how many users there are:
	echo "<p style='color:#02623E;'><strong>There are currently $num registered Students on the portal.</strong></p>\n <hr>";

echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
	<td style="color:#f90" align="left"><b>Edit</b></td>
	<td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_students.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="view_students.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="view_students.php?sort=ul">User Level</a></b></td>
	<td align="left"><b><a href="view_students.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['user_level'] . '</td>
		<td align="left">' . $row['dr'] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_students.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="submit2"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_students.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_students.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="submit2"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
 }// End view students

 function count_users(){
                //need MYSQL
                        require(MYSQL);

                        // Define the query to determine the total number of  registered users:
                        $q = "SELECT * FROM users ";     
                        $r = @mysqli_query ($dbc, $q); // Run the query.
                        // Count the number of returned rows:
                        $num = mysqli_num_rows($r);


                        $q1 = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='1' ";     
                        $r1 = @mysqli_query ($dbc, $q1); // Run the query.
                        // Count the number of returned rows:
                        $num1 = mysqli_num_rows($r1);

                         $q2 = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='2' ";     
                        $r2 = @mysqli_query ($dbc, $q2); // Run the query.
                        // Count the number of returned rows:
                        $num2 = mysqli_num_rows($r2);


 }// EndUser coount 
 
 //start view subjects
 function view_subjects(){
	 //need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(subject_id) FROM subjects";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'sn':
		$order_by = 'subject_name ASC';
		break;
	case 'id':
		$order_by = 'subject_id ASC';
		break;
	case 'rd':
		$order_by = 'created_at ASC';
		break;
	default:
		$order_by = 'subject_id ASC';
		$sort = 'id';
		break;
}


// Define the query:
$q = "SELECT subject_name, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, subject_id FROM subjects ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo ' <h3 style ="color:#02623E">All Registered Courses</h3><hr>';
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
	<td style="color:#f90" align="left"><b>Edit</b></td>
	<td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_subjects.php?sort=id">Subject ID.</a></b></td>
	<td align="left"><b><a href="view_subjects.php?sort=sn">Subjects</a></b></td>
	<td align="left"><b><a href="view_subjects.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_subject.php?id=' . $row['subject_id'] . '">Edit</a></td>
		<td align="left"><a href="delete_subject.php?id=' . $row['subject_id'] . '">Delete</a></td>
		<td align="left">' . $row['subject_id'] . '</td>
		<td align="left">' . $row['subject_name'] . '</td>
		<td align="left">' . $row['dr'] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_subjects.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="submit2"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_subjects.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_subjects.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="submit2"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
 }//end view subjects

  //start view subjects
 function view_subjects2(){
	 //need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(subject_id) FROM subjects";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'sn':
		$order_by = 'subject_name ASC';
		break;
	case 'id':
		$order_by = 'subject_id ASC';
		break;
	case 'rd':
		$order_by = 'created_at ASC';
		break;
	default:
		$order_by = 'subject_id ASC';
		$sort = 'id';
		break;
}


// Define the query to deteremine the totalnumber of subjects:
$q = "SELECT subject_name, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, subject_id FROM subjects";		
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num2 = mysqli_num_rows($r);
if ($num2 > 0) { // If it ran OK, display the records.
// do nothing
}



// Define the query:
$q = "SELECT subject_name, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, subject_id FROM subjects ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.


// Table header:
echo ' <h3 style ="color:#02623E">All Registered Subjects</h3>';
// Print the total number of registered subject:
	echo "<p style='color:#02623E;'><strong>There are currently $num2 registered Subjects on the portal.</strong></p>\n <hr>";
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
	<td style="color:#f90" align="left"><b>Edit</b></td>
	<td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_subjects.php?sort=id">Subject ID.</a></b></td>
	<td align="left"><b><a href="view_subjects.php?sort=sn">Subjects</a></b></td>
	<td align="left"><b><a href="view_subjects.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="#">Edit</a></td>
		<td align="left"><a href="#">Delete</a></td>
		<td align="left">' . $row['subject_id'] . '</td>
		<td align="left">' . $row['subject_name'] . '</td>
		<td align="left">' . $row['dr'] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_subjects2.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="submit2"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_subjects2.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_subjects2.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="submit2"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
	
 }//end view subjects2
 
 
 //start messages
 function messages(){
	// need MYSQL
	require(MYSQL);
// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(message_id) FROM messages";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records =$row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'dd';

// Determine the sorting order:
switch ($sort) {
	case 'name':
		$order_by = 'sender_name ASC';
		break;
		case 'mss':
		$order_by = 'content ASC';
		break;
		case 'ul':
		$order_by = 'sender_level ASC';
		break;
	case 'dd':
		$order_by = 'delivery_date ASC';
		break;
	default:
		$order_by = 'delivery_date ASC';
		$sort = 'dd';
		break;
}
	
// Define the query:
$q = "SELECT sender_name, sender_level, content, DATE_FORMAT(delivery_date, '%M %d, %Y') AS dd, message_id FROM messages ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo ' <h3 style ="color:#02623E">All Messages</h3><hr>';
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr bgcolor="#02623E">
    <td style="color:#f90" align="left"><b>Delete</b></td>
	<td align="left"><b><a href="read_message.php?sort=name">Sender Name </a></b></td>
	<td align="left"><b><a href="read_message.php?sort=ul">Role</a></b></td>
	<td align="left"><b><a href="read_message.php?sort=mss">Message</a></b></td>
	<td align="left"><b><a href="read_message.php?sort=dd">Date</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
  if(isset($row[1])){
  	$role = $row[1];
  }

  if ($role == 1){
	$role = "Student";
}else{
	$role = "Teacher";
}  
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="delete_message.php?id=' . $row[4] . '">Delete</a></td>
		<td align="left">' . $row[0] . '</td>
		<td align="left">' . $role . '</td>
		<td align="left">' . $row[2] . '</td>
		<td align="left">' . $row[3] . '</td>

	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="read_message.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="submit2"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="read_message.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="read_message.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="submit2"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.

 }// End message function

 //Forgot password function
 function forgot_password() {
 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	// Assume nothing:
	$uid = FALSE;

	// Validate the email address...
	if (!empty($_POST['email'])) {

		// Check for the existence of that email address...
		$q = 'SELECT user_id FROM users WHERE email="'.  mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) { // Retrieve the user ID:
			list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
		} else { // No database match made.
			echo '<p class="error">The submitted email address does not match those on file!</p>';
		}
		
	} else { // No email!
		echo '<p class="error">You forgot to enter your email address!</p>';
	} // End of empty($_POST['email']) IF.
	
	if ($uid) { // If everything's OK.

		// Create a new, random password:
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		// Update the database:
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
		
		// Send an email:
			$body = "Your password to log into RevisionPad has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
			mail ($_POST['email'], 'Your temporary password.', $body, 'From: info@diginettechnologies.com');
			
			// Print a message and wrap up:
			echo '<script> swal("Password Change Successful!", "Your password has been changed. Check your email address for your new password!", "success");
			</script>';	
		echo'<div class="container col-md-4" align ="center" style="padding-top:20px;" >';
		  echo '<a class="btn btn-primary btn-lg btn-block" href="login.php">LOG IN</a>';
		  echo'</div>';		
			mysqli_close($dbc);
			include ('includes/footer_front.php');
			exit(); // Stop the script.
			
		} else { // If it did not run OK.
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
		}

	} else { // Failed the validation test.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} // End of the main Submit conditional.


 }

