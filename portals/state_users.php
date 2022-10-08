<?php 
require('inc/config.php'); 
$page_title = ' Registered Members by State';
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
$display = 20;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
  $pages = $_GET['p'];
} else { // Need to determine.
  // Count the number of records:
  $q = "SELECT COUNT(state_id) FROM states";
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
// $q = "SELECT st.state_id, state_name, count(u.state) AS user_count FROM states AS st JOIN users AS u ON u.state_id = st.state_id GROUP BY st.state_id ORDER BY user_count DESC ";
// $r = @mysqli_query ($dbc, $q); // Run the query.

// //Count the number of returned rows:
// $num = mysqli_num_rows($r);

// if ($num > 0) { // If it ran OK, display the records.
// //do nothing
// }
  
// Define the query:
$q = "SELECT  state_name, u.state_id AS id, count(u.first_name) AS user_count FROM states AS st JOIN users AS u ON u.state_id = st.state_id GROUP BY st.state_id ORDER BY user_count DESC  LIMIT $start, $display ";

$r = @mysqli_query ($dbc, $q); // Run the query.
if (!$r) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
}

// Table header:
//echo "<h3 style='color:#036622;'><strong align='center'>There are currently $num state's with registered members</strong></h3>\n <hr>";
echo '<table id="searchusers" align="left" cellspacing="2" cellpadding="5" width="100%" class="table table-striped">
<tr>
  
  
  <th align="left"><b>state Name</a></b></th>
  <th align="left"><b>Members</b></th>
    <th align="left"><b>Action</b></th>
</tr>
';
 
// Fetch and print all the records....

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {



    echo '<tr>
    
  
    <td align="left">' . $row['state_name'] . '</td>
    <td align="left"><span class=""><big>'.$row['user_count'].' </big>Members</span></td>
    <td align="left"><a href="show_user_by_state.php?id=' . $row['id'] . '"><span class="btn btn-danger"><i class="fas fa-eye"></i> View Members</span></a></td>
    

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
    echo '<a href="state_users.php?s=' . ($start - $display) . '&p=' . $pages . '"><input name="button" type="button" value="Previous" class="btn btn-primary"/></a> ';
  }
  
  // Make all the numbered pages:
  for ($i = 1; $i <= $pages; $i++) {
    if ($i != $current_page) {
      echo '<a href="state_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
    } else {
      echo $i . ' ';
    }
  } // End of FOR loop.
  
  // If it's not the last page, make a Next button:
  if ($current_page != $pages) {
    echo '<a href="state_users.php?s=' . ($start + $display) . '&p=' . $pages  . '"><input name="button" type="button" value="Next" class="btn btn-primary"/></a>';
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