<?php 
require('inc/config.php'); 
$page_title = ' All Political Wards in Nigeria';
include('inc/dheader.php');
include ('inc/functions.php');

//Redirect invalid ward
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

        

 
<?php

//need MYSQL
require(MYSQL);
// Number of records to show per page:
$display = 15;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
  $pages = $_GET['p'];
} else { // Need to determine.
  // Count the number of records:
  $q = "SELECT COUNT(ward_id) FROM ward";
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
    $order_by = 'state_name DESC';
    break;
  case 'fn':
    $order_by = 'lga_name DESC';
    break;
  case 'ph':
    $order_by = 'ward_name ASC';
    break;
  case 'ul':
    $order_by = 'ward_level ASC';
    break;
  default:
    $order_by = 'state_name DESC';
    $sort = 'ln';
    break;
}



  // Define the query to determine the total number of  registered wards:
  $q = 
  "SELECT ward_id, state_name, lga_name, ward_name, wa.state_id AS stid, wa.lga_id AS lid
  FROM ward AS wa 
  JOIN lga AS lg    ON  wa.lga_id = lg.lga_id
  JOIN states AS st ON  wa.state_id = st.state_id 
  GROUP BY wa.ward_id ORDER BY ward_id, state_name, lga_name DESC  LIMIT $start, $display ";
  
  $r = @mysqli_query ($dbc, $q); // Run the query.
  if (!$r) {
      printf("Error: %s\n", mysqli_error($dbc));
      exit();
  }
  $num = mysqli_num_rows($r);  

if ($num > 0) { // If it ran OK, display the records.

// Table header:
//echo "<h3 style='color:#036622;'><strong align='center'>There are". $row['ward_id']." registered Wards on the system</strong></h3>\n <hr>";
echo '<table id="searchwards" align="left" cellspacing="2" cellpadding="5" width="100%" class="table table-striped">
<tr>
  
  <th align="left"><b><a href="view_wards.php?sort=ln">State</a></b></th>
  <th align="left"><b><a href="view_wards.php?sort=fn">LGA</a></b></th>
  <th align="left"><b><a href="view_wards.php?sort=ph">Ward</a></b></th>
  <th   align="left"><b>Edit</b></th>
  <th  align="left"><b>Delete</b></th>
</tr>
';
 
   // Fetch and print all the records....

   while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {



    echo '<tr>
    
    <td align="left">' . $row['state_name'] . '</td>
    <td align="left">' . $row['lga_name'] . '</td>
    <td align="left">' . $row['ward_name'] . '</td>
    <td align="left"><a href="edit_ward.php?id=' . $row['ward_id'] . '"><span class="btn btn-primary">Edit</span></a></td>
    <td align="left"><a href="delete_ward.php?id=' . $row['ward_id'] . '"><span class="btn btn-danger">Delete</span></a></td>

  </tr>
  ';
} // End of WHILE loop.

}//End if it ran ok

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);


// Make the links to other pages, if necessary.
if ($pages > 1) {
  
  echo '<br /><p>';
  $current_page = ($start/$display) + 1;
  
  // If it's not the first page, make a Previous button:
  if ($current_page != 1) {
    echo '<a href="view_wards.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Previous" class="btn btn-primary"/></a> ';
  }
  
  // Make all the numbered pages:
  for ($i = 1; $i <= $pages; $i++) {
    if ($i != $current_page) {
      echo '<a href="view_wards.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
    } else {
      echo $i . ' ';
    }
  } // End of FOR loop.
  
  // If it's not the last page, make a Next button:
  if ($current_page != $pages) {
    echo '<a href="view_wards.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '"><input name="button" type="button" value="Next" class="btn btn-primary"/></a>';
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