<?php 
require('inc/config.php'); 
$page_title = 'ward Members' ;
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
  $url = BASE_URL . 'index.php'; // Define the URL.
  ob_end_clean(); // Delete the buffer.
  header("Location: $url");
  exit(); // Quit the script. 
}

//need MYSQL
require(MYSQL);

// Check for a valid  ID, through GET or POST:
    if ( (isset($_GET['wid'])) && (is_numeric($_GET['wid'])) ) { // From show_user_by_ward.php
        $wid = $_GET['wid'];
    } elseif ( (isset($_POST['wid'])) && (is_numeric($_POST['wid'])) ) { // Form submission.
        $wid = $_POST['wid'];
    } else { // No valid ID, kill the script.
        echo '<p class="error">This page has been accessed in error.</p>';
        include ('inc/dfooter.php'); 
        exit();
    }

?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

        

 
<?php


// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
  $pages = $_GET['p'];
} else { // Need to determine.
  // Count the number of records:
  $q = "SELECT COUNT(ward_id) FROM users WHERE ward_id = $wid";
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
$q = "SELECT last_name, first_name, phone, user_level,  DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users WHERE ward_id = $wid";   
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
    $q = "SELECT ward_name FROM  ward WHERE ward_id = $wid";
    $r = @mysqli_query ($dbc, $q); // Run the query.
 $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
 $ward_name = $row['ward_name'];

}
  
// Define the query:
$q = "SELECT last_name, first_name, phone, user_level, DATE_FORMAT(created_at, '%M %d, %Y') AS dr, user_id FROM users where ward_id = $wid ORDER BY $order_by LIMIT $start, $display";    
$r = @mysqli_query ($dbc, $q); // Run the query.
if (!$r) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
}

// Table header:
echo "<h3 style='color:#036622;'><strong align='center'>There are currently $num registered Members in $ward_name ward</strong></h3>\n <hr>";
echo '<table id="searchusers" align="left" cellspacing="2" cellpadding="5" width="100%" class="table table-striped">
<tr>
  
  <th align="left">Last Name</th>
  <th align="left">First Name</th>
  <th align="left">Phone Number</th>
  <th align="left">User Level</th>
  <th align="left">Date Registered</th>
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
    $cat = "Regular";
    break;
  case 2:
    $cat = "Administrator";
    break;
  
  default:
    $cat = "Administrator";
    break;
}//end switch


    echo '<tr>
    
    <td align="left">' . $row['last_name'] . '</td>
    <td align="left">' . $row['first_name'] . '</td>
    <td align="left">' . $row['phone'] . '</td>
    <td align="left">' . $cat . '</td>
    <td align="left">' . $row['dr'] . '</td>
    <td align="left"><a href="#?id=' . $row['user_id'] . '"><span class="btn btn-primary">Edit</span></a></td>
    <td align="left"><a href="#?id=' . $row['user_id'] . '"><span class="btn btn-danger">Delete</span></a></td>

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
    echo '<a href="show_user_by_ward.php?id='.$id.'&s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="btn btn-primary"/></a> ';
  }
  
  // Make all the numbered pages:
  for ($i = 1; $i <= $pages; $i++) {
    if ($i != $current_page) {
      echo '<a href="show_user_by_ward.php?id='.$id.'&s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
    } else {
      echo $i . ' ';
    }
  } // End of FOR loop.
  
  // If it's not the last page, make a Next button:
  if ($current_page != $pages) {
    echo '<a href="show_user_by_ward.php?id='.$id.'&s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="btn btn-primary"/></a>';
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