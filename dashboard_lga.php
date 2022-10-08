<?php 
require('inc/config.php'); 
$page_title = 'lga Dashboard';
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
if ($_SESSION['user_level'] <2  || $_SESSION['user_level'] >24 ) {	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}


?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

<div class="col-md-12">    

<?php

if( (isset($_GET['sid'])) && (is_numeric($_GET['sid'])) ) { 
  $state_code = $_GET['sid'];
  }elseif( (isset($_POST['state_id'])) && (is_numeric($_POST['state_id'])) ) { 
  $state_code = $_POST['state_id'];
  }else{
$state_code = $_SESSION['state_id'] ;
  }

if( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
  $lga_code = $_GET['id'];
  }elseif( (isset($_POST['lga_id'])) && (is_numeric($_POST['lga_id'])) ) { 
  $lga_code = $_POST['lga_id'];
  }else{
$lga_code = $_SESSION['lga_id'] ;
  }

//need MYSQL
require(MYSQL);
      

if ($_SESSION['user_level'] ==2 ){// drop lga selection menu
  echo'

  <form method="post" action="dashboard_lga.php">
  <table class="table">
  <tr class="col-lg-9 col-9">   
  
  <td class="col-lg-3 col-3"> 
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

  </div>
  </td>

      <td class="col-lg-3 col-3"> 
      <div class="form-group">
         <label for="lga">Filter lga</label>
                     <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                     <select name="lga_id" class="form-control" id="lga-dropdown">                                              
                     </select>
       </div>
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
$lga_code = $_SESSION['lga_id'] ;
}
?>
<div class="row"><hr/></div>
</div>
   <?php
      
      // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
                         AND state_id = $state_code  AND lga_id = $lga_code ";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $new_members = mysqli_num_rows($r); // Count the number of returned rows:
                    }else{
                      $new_members = 0;
                    }


                       // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM lga WHERE lga_id = $lga_code AND state_id = $state_code";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_lga = mysqli_num_rows($r); // Count the number of returned rows:
                    }else{
                      $num_lga = 0;
                    }


                        // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM ward  WHERE ward_id LIKE '$state_code-$lga_code-%'";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_ward = mysqli_num_rows($r); // Count the number of returned rows:
                    }else{
                      $num_ward = 0;
                    }


                        // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM polling_unit  WHERE pu_id LIKE '$state_code-$lga_code-%'";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_pu = mysqli_num_rows($r); // Count the number of returned rows:
                    }else{
                      $num_pu = 0;
                    }

                        // Define the query to determine the total number of  registered users:
                        $q = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='1' AND state_id = $state_code  AND lga_id = $lga_code";     
                        $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                     if (mysqli_num_rows($r) > 0) { // Available. 
                        $eVoters = mysqli_num_rows($r); // Count the number of returned rows:
                     }else{
                      $eVoters = 0;
                    }

                    $q = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='2' AND state_id = $state_code  AND lga_id = $lga_code ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $iVoters = mysqli_num_rows($r);
                        }else{
                          $iVoters = 0;
                        }


                        $q = "SELECT first_name, last_name, phone FROM users WHERE lga_id = $lga_code AND state_id = $state_code ";     
                        $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $all_members = mysqli_num_rows($r);
                        }else{
                          $all_members = 0;
                        }


                       $q = "SELECT first_name, last_name, phone FROM users WHERE user_level > 1 AND lga_id =$lga_code AND state_id = $state_code ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $exco_members = mysqli_num_rows($r);
                        }else{
                          $exco_members = 0;
                        }


                       $q = "SELECT lga_id FROM users WHERE lga_id = $lga_code AND state_id = $state_code";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $lga = mysqli_fetch_array($r, MYSQLI_ASSOC);
                        }else{
                          $lga = 0;
                        }
                      
                       $q = "SELECT DISTINCT lga_id FROM users WHERE lga_id = $lga_code AND state_id = $state_code";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_lga = mysqli_num_rows($r);
                        }else{
                          $m_lga = 0;
                        }

                       $q = "SELECT DISTINCT lga_id FROM users WHERE lga_id = $lga_code AND state_id = $state_code ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_lga = mysqli_num_rows($r);
                        }else{
                          $m_lga = 0;
                        }

                       $q = "SELECT DISTINCT ward_id FROM users WHERE lga_id = $lga_code AND state_id = $state_code ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_ward = mysqli_num_rows($r);
                        }else{
                          $m_ward = 0;
                        }

                       $q = "SELECT DISTINCT pu_id FROM users WHERE lga_id = $lga_code AND state_id = $state_code ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_pu = mysqli_num_rows($r);
                        }else{
                          $m_pu = 0;
                        }

$r->close();
mysqli_close($dbc);


?>

   <script>
    var lgaData = <?php echo json_encode($lga); ?>
  </script>

<div class="row">
        <div class="col-md-12">    
        <!-- PIE CHART -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">lga  Statistics</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">

             <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><i class="fas fa"></i><?php  echo " ".$new_members; ?></h3>

                <p> New Members Today </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="view_lga_member_today.php" class="small-box-footer"> More Info &rarr;<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> <i class="fas  fa"></i><?php  echo " ".$m_lga; ?></h3>

                <p> Out of <b><?php echo $num_lga ?></b> LGA </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lga_users_lga.php" class="small-box-footer">More info  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fas fa-"></i><?php echo " ".$m_ward; ?></h3>

                <p>Out of <b><?php echo $num_ward ?></b> Wards</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="ward_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><i class="fas fa"></i><?php echo " ".$m_pu; ?></h3>

                <p> Out of <b><?php echo $num_pu ?></b> PU</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="pu_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div> <!-- /.row -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fas fa-graduation-cap"></i><?php  echo " ".$eVoters; ?></h3>

                <p>Eligible Voters <em>PVC Ready</em></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="evoters.php" class="small-box-footer"> More Info &rarr;<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> <i class="fas  fa-graduation-cap"></i><?php  echo " ".$iVoters; ?></h3>

                <p>Ineligible Voters - <em>NO PVC</em></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="ivoters.php" class="small-box-footer">More info  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><i class="fas fa-users"></i><?php echo " ".$all_members; ?></h3>

                <p>All Members</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="view_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><i class="fas fa-users"></i><?php echo " ".$exco_members; ?></h3>

                <p>Exco Members</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div> <!-- /.row -->

    </div> <!-- /.card-body -->
    </div>  <!-- /.card -->
    </div>  <!-- /.col rigth -->
    </div>  <!-- /.row -->

    
     
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
      <p>Sidebar content for dashboard</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
  <!-- lga Gender Pie Chart -->

   


  <?php require('inc/dfooter.php'); ?>