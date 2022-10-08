<?php 
require('inc/config.php'); 
$page_title = 'Member Distribution By LGA' ;
include('inc/dheader.php');
include ('inc/functions.php');



//Redirect invalid user
if (!isset($_SESSION['user_id']) && !isset($_SESSION['phone']) && !isset($_SESSION['email'])) {
	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}


//Redirect invalid admin
if ($_SESSION['user_level'] != 2) {	
	$url = BASE_URL . 'state_lga_users.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}

?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

<section class="col-lg-10 col-12">

 
<?php

//need MYSQL
require(MYSQL);

// Check for a valid State ID, through GET or POST:
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From show_user_by_state.php
        $id = $_GET['id'];
    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
        $id = $_POST['id'];
    } else { // No valid ID, kill the script.
        echo '<p class="error">This page has been accessed in error.</p>';
        include ('inc/dfooter.php'); 
        exit();
    }


// Number of records to show per page:
$display = 100;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT DISTINCT COUNT(lga_id) FROM users WHERE state_id = $id";
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




//	Define the query to determine the total number of  registered users:
$q = "SELECT first_name, last_name FROM users WHERE state_id = $id";
$r = @mysqli_query ($dbc, $q); // Run the query.
//Count the number of returned rows:
$num = mysqli_num_rows($r);
if ($num > 0) { // If it ran OK, display the records.
    // $q = "SELECT state_name FROM  states WHERE state_id = $id";
    // $r = @mysqli_query ($dbc, $q); // Run the query.
    // $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    // $state_name = $row['state_name'];
}


$q = "SELECT state_name FROM  states WHERE state_id = $id";
$r = @mysqli_query ($dbc, $q); // Run the query.
$num2 = mysqli_num_rows($r);
if ($num2 > 0) { 
$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
$state_name = $row['state_name'];
}


// Define the query:
$q ="SELECT ROW_NUMBER() OVER (ORDER BY u.first_name) AS sn, state_name, lga_name, u.user_id AS id, u.state_id AS stid, u.lga_id AS lid, count(u.first_name) AS user_count 
FROM users AS u  
JOIN lga AS lg    ON  u.lga_id = lg.lga_id
JOIN states AS st ON  u.state_id = st.state_id 
WHERE u.state_id = $id GROUP BY u.lga_id ORDER BY sn, lga_name, user_count ASC  LIMIT $start, $display ";
$r = @mysqli_query ($dbc, $q); // Run the query.
if(!$r) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
}

// Table header:
echo "<h3 style='color:#036622;'><strong align='center'>There are currently $num registered Members in $state_name state</strong></h3>\n <hr>";
echo '<table  align="left" cellspacing="2" cellpadding="5" width="100%" class="table table-striped">
<tr>
	
	<th align="left"><b>S/N</a></b></th>
	<th align="left"><b>LGA </a></b></th>
	<th align="left"><b>Members</b></th>
</tr>
';
 
// Fetch and print all the records....
 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {



echo '
        <tr>		
		<td align="left">' . $row['sn'] . '</td>
		<td align="left">' . $row['lga_name'] .   '</td>
		<td align="left"><span class=""><big>'.$row['user_count'].' </big>Members</span></td>		
        </tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);
 
?>

</section>


          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php require('inc/dfooter.php'); ?>