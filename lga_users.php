<?php 
require('inc/config.php'); 
$page_title = 'Members by LGA';
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
// Number of records to show per page:
$display = 100;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT DISTINCT COUNT(lga_id) FROM users";
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




	// Define the query to determine the total number of  registered users:
//$q = "SELECT l.lga_id, lga_name, count(u.lga) AS user_count FROM lga AS l JOIN users AS u ON u.lga_id = l.lga_id GROUP BY l.lga_id ORDER BY user_count DESC ";
//$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
//$num = mysqli_num_rows($r);

//if ($num > 0) { // If it ran OK, display the records.
// do nothing
//}
	
// Define the query:
$q = 
"SELECT state_name, lga_name, u.user_id AS id, u.state_id AS stid, u.lga_id AS lid, count(u.first_name) AS user_count 
FROM users AS u  
JOIN lga AS lg    ON  u.lga_id = lg.lga_id
JOIN states AS st ON  u.state_id = st.state_id 
GROUP BY u.lga_id ORDER BY state_name, lga_name, user_count DESC  LIMIT $start, $display ";
$r = @mysqli_query ($dbc, $q); // Run the query.
if (!$r) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
}

// Table header:
//echo "<h3 style='color:#036622;'><strong align='center'>There are currently $num LGA's with registered members</strong></h3>\n <hr>";
echo '<table id="searchusers" align="left" cellspacing="2" cellpadding="5" width="100%" class="table table-striped">
<tr>
	
	<th align="left"><b>State</a></b></th>
	<th align="left"><b>LGA </a></b></th>
	<th align="left"><b>Members</b></th>
    <th align="left"><b>Action</b></th>
</tr>
';
 
// Fetch and print all the records....

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {



		echo '<tr>
		
		<td align="left">' . $row['state_name'] . '</td>
		<td align="left">' . $row['lga_name'] . '</td>
		<td align="left"><span class=""><big>'.$row['user_count'].' </big>Members</span></td>
		<td align="left"><a href="show_user_by_lga.php?lid=' . $row['lid'] . '"><span class="btn btn-danger"><i class="fas fa-eye"></i> View Members</span></a> &nbsp; <a href="dashboard_lga.php?id=' . $row['lid'] . '&sid=' . $row['stid']. '"><span class="btn btn-success"><i class="fas fa-arrow-right"></i> Goto LGA Dashboard</span></a></td>
		</td>
		

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
		echo '<a href="lga_users.php?s=' . ($start - $display) . '&p=' . $pages . '"><input name="button" type="button" value="Previous" class="btn btn-primary"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="lga_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="lga_users.php?s=' . ($start + $display) . '&p=' . $pages  . '"><input name="button" type="button" value="Next" class="btn btn-primary"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.

 
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