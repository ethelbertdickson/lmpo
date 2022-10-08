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
if ($_SESSION['user_level'] <2  || $_SESSION['user_level'] >16 ) {	
	$url = BASE_URL . 'lga_users_state.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}

?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

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

  <form method="post" action="lga_users_state.php">
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

<!-- <section class="col-lg-10 col-12"> -->

 
<?php


// Number of records to show per page:
$display = 100;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT DISTINCT COUNT( DISTINCT lga_id) FROM users WHERE state_id =$state_code";
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
	
// Define the query:
$q = 
"SELECT state_name, lga_name, u.user_id AS id, u.state_id AS stid, u.lga_id AS lid, count(u.first_name) AS user_count 
FROM users AS u  
JOIN lga AS lg    ON  u.lga_id = lg.lga_id
JOIN states AS st ON  u.state_id = st.state_id 
WHERE st.state_id =$state_code GROUP BY u.lga_id ORDER BY state_name, lga_name, user_count DESC  LIMIT $start, $display ";
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
    <th align="left"><b>View </b></th>
    <th align="left"><b>Dashboard</b></th>
</tr>
';
 
// Fetch and print all the records....

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {



		echo '<tr>
		
		<td align="left">' . $row['state_name'] . '</td>
		<td align="left">' . $row['lga_name'] . '</td>
		<td align="left"><span class=""><big>'.$row['user_count'].' </big>Members</span></td>
		<td align="left"><a href="show_user_by_lga.php?lid=' . $row['lid'] . '"><span class="btn btn-danger"><i class="fas fa-eye"></i> View Members</span></a></td>
        <td align="left"><a href="dashboard_lga.php?id=' . $row['lid'] . '&sid=' . $row['stid']. '"><span class="btn btn-success"><i class="fas fa-arrow-right"></i> Goto LGA Dashboard</span></a></td>
    

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