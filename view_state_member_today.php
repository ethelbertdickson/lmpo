<?php 
require('inc/config.php'); 
$page_title = 'New Members';
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
if ($_SESSION['user_level'] <2  || $_SESSION['user_level'] >16 ) {	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}


?>
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


<?php

if( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
  $state_code = $_GET['id'];
  }elseif( (isset($_POST['state_id'])) && (is_numeric($_POST['state_id'])) ) { 
  $state_code = $_POST['state_id'];
  }else{
$state_code = $_SESSION['state_id'] ;
  }
//need MYSQL
require(MYSQL);
      

if ($_SESSION['user_level'] ==2 ){// drop state selection menu
  echo'

  <form method="post" action="view_state_member_today.php">
  <table class="table">
  <tr class="col-lg-7 col-7">               

      <td class="col-lg-4 col-4"> 
      <div class="form-group">
         <label for="state">Filter State</label>
                     <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
             <select name="state_id" class="form-control" id="state-dropdown"> . ' ?>
             <?php
             $q = "SELECT state_id, state_name FROM states ORDER BY state_id = $state_code DESC, state_id ASC";
             $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
             while($row = mysqli_fetch_array($r)) {
             ?>
             <option value="<?php echo $row['state_id'];?>" ><?php echo $row["state_name"];?></option>
             <?php
             }
             ?>                           
 <?php  echo '          </select>
        </td>  


        <td class="col-lg-3 col-3">   
        <div class="form-group">
        <label for="filter"><em></label>
          <button id="filter" type="submit" class="btn-primary btn-lg btn-block">Apply Filter</button>
          </div>
        </td>
  </tr><!-- End Row --> 


  </table>
  
  ';

}else{
$state_code = $_SESSION['state_id'] ;
}
?>


<div class="row"><hr/></div>
  
        

 
<?php

// Number of records to show per page:
$display = 100;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
$q = "SELECT COUNT(user_id) FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) AND state_id = $state_code ";
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

// Determine WHERE state_id = $state_code AND  in the database to start returning results...
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
	case 'ph':
		$order_by = 'phone ASC';
		break;
	case 'ul':
		$order_by = 'user_level ASC';
		break;
	case 'rd':
		$order_by = 'created_at DESC';
		break;
	default:
		$order_by = 'created_at DESC';
		$sort = 'rd';
		break;
}



	// Define the query to determine the total number of  registered users:
$q = "SELECT last_name, first_name, phone, user_level,  DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE state_id = $state_code AND  created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) ";		
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
// do nothing
}
	
// Define the query:
$q = "SELECT last_name, first_name, phone, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE state_id = $state_code AND  created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)  ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.
if (!$r) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
}

// Table header:
echo "<h3 style='color:#036622;'><strong align='center'>There are currently $num registered Members Today</strong></h3>\n <hr>";
echo '<table id="searchusers" align="left" cellspacing="2" cellpadding="5" width="100%" class="table table-striped">
<tr>
	
	<th align="left"><b><a href="view_state.member_today.php?sort=ln">Last Name</a></b></th>
	<th align="left"><b><a href="view_state.member_today.php?sort=fn">First Name</a></b></th>
	<th align="left"><b><a href="view_state.member_today.php?sort=ph">Phone Number</a></b></th>
	<th align="left"><b><a href="view_state.member_today.php?sort=ul">User Role</a></b></th>
	<th align="left"><b><a href="view_state.member_today.php?sort=rd">Date Registered</a></b></th>
	<th   align="left"><b>Edit</b></th>
    <th  align="left"><b>Delete</b></th>
</tr>
';
 
// Fetch and print all the records....

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

	$cat = $row['user_level'];
 //determine cateory of users
switch ($cat) {
	case 1:
		$cat = "Regular Member";
		break;
	case 2:
		$cat = "Super Administrator";
		break;
	case 3:
		$cat = "Regional  Coordinator";
		break;
	case 4: 
		$cat = "Regional Laison Officer";
		break;
	case 5:
		$cat = "State coordinator";
		break;
	case 6:
		$cat = "State Deputy Coordinator";
		break;
	case 7:
	$cat = "State Admin Secretary";
			break;
	case 8:
	$cat = "State Deputy Admin Secretary";
			break;
	case 9: 
	$cat = "State Finance and Budget direcror";
			break;
	case 10:
	$cat = "State Strategic Planning/ Logistics director";
			break;
			
	case 11:
	$cat = "State Publicity/Organizing Secretary";
				break;
	case 12:
	$cat = "State Youths Network Leader";
				break;
	case 13:
	$cat = "State Women Leader";
				break;
	case 14: 
	$cat = "State Deputy Women Leader";
				break;
	case 15:
	$cat = "State Media/ICT/Technical director ";
				break;
	case 16:
    $cat = "State Grassroots Mobilization director ";
				break;
	case 17:
	$cat = "LGA Coordinator";
					break;
	case 18:
    $cat = "LGA Deputy Coordinator";
					break;
	case 19: 
	$cat = "LGA Secretary";
					break;					 	
	case 20:
	$cat = "LGA Finance and Budget Director";
					break;
					
	case 21:
	$cat = "LGA Head of Organizing/ Planning";
						break;
	case 22:
	$cat = "LGA Youths Network Leader";
						break;
	case 23:
	$cat = "LGA Women Leader";
						break;
	case 24: 
	$cat = "LGA Media/Technical Coordinator";
						break;
	case 25:
   $cat = "Ward Chairman/Liaison Officer";
						break;
	case 26:
    $cat = "Polling Unit Team Leader";
							break;
	case 27:
	$cat = "Voter Mobilizer ";
						break;	
					default:
						$cat = "Regular Member";
						break;
}//end switch


		echo '<tr>
		
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['phone'] . '</td>
		<td align="left">' . $cat . '</td>
		<td align="left">' . $row['dr'] . '</td>
		<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '"><span class="btn btn-primary">Edit</span></a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '"><span class="btn btn-danger">Delete</span></a></td>

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
		echo '<a href="view_state.member_today.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="btn btn-primary"/></a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_state.member_today.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_state.member_today.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="btn btn-primary"/></a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.

 
?>



          
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