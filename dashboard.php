<?php 
require('inc/config.php'); 
$page_title = ' Admin Dashboard';
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
	$url = BASE_URL . 'dashboard_state.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}
?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
   <?php
      //need MYSQL
                        require(MYSQL);

// include map count file
include('map_count_members.php');


                       // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM states  ";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_state = mysqli_num_rows($r); // Count the number of returned rows:
                    }


                       // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM lga ";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_lga = mysqli_num_rows($r); // Count the number of returned rows:
                    }


                        // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM ward ";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_ward = mysqli_num_rows($r); // Count the number of returned rows:
                    }


                        // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM polling_unit ";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_pu = mysqli_num_rows($r); // Count the number of returned rows:
                    }

                        // Define the query to determine the total number of  registered users:
                        $q = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='1' ";     
                        $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                     if (mysqli_num_rows($r) > 0) { // Available. 
                        $eVoters = mysqli_num_rows($r); // Count the number of returned rows:
                     }

                    $q = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='2' ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $iVoters = mysqli_num_rows($r);
                        }


                        $q = "SELECT first_name, last_name, phone FROM users ";     
                        $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $users = mysqli_num_rows($r);
                        }


                       $q = "SELECT first_name, last_name, phone FROM users WHERE user_level > 1  ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $exco = mysqli_num_rows($r);
                        }


                       $q = "SELECT lga_id FROM users ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $lga = mysqli_fetch_array($r, MYSQLI_ASSOC);
                        }
                      
                       $q = "SELECT DISTINCT state_id FROM users ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_state = mysqli_num_rows($r);
                        }

                       $q = "SELECT DISTINCT lga_id FROM users ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_lga = mysqli_num_rows($r);
                        }

                       $q = "SELECT DISTINCT ward_id FROM users ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_ward = mysqli_num_rows($r);
                        }

                       $q = "SELECT DISTINCT pu_id FROM users ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        //$lga = mysqli_num_rows($r1);
                        $m_pu = mysqli_num_rows($r);
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
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Nationwide  Statistics</h3>

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
                <h3><i class="fas fa"></i><?php  echo " ".$m_state; ?></h3>

                <p> Out of <b><?php echo $num_state ?></b> States in Nigeria </p>
                <p style= "float: right;"><b><?php echo round(($m_state/$num_state *100),2)."%"; ?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="state_users.php" class="small-box-footer"> More Info &rarr;<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> <i class="fas  fa"></i><?php  echo " ".$m_lga; ?></h3>

                <p> Out of <b><?php echo $num_lga ?></b> LGA in Nigeria</p>
                <p style= "float: right;"><b><?php echo round(($m_lga/$num_lga *100),2)."%"; ?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lga_users.php" class="small-box-footer">More info  <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fas fa-"></i><?php echo " ".$m_ward; ?></h3>

                <p>Out of <b><?php echo $num_ward ?></b> Wards in Nigeria</p>
                <p style= "float: right;"><b><?php echo round(($m_ward/$num_ward *100),2)."%"; ?></b></p>
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

                <p> Out of <b><?php echo $num_pu ?></b> PU in Nigeria </p>
                <p style= "float: right;"><b><?php echo round(($m_pu/$num_pu *100),2)."%"; ?></b></p>
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
                <h3><?php  echo " ".$eVoters; ?></h3>

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
                <h3> <?php  echo " ".$iVoters; ?></h3>

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
                <h3><?php echo " ".$users; ?></h3>

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
                <h3><?php echo " ".$exco; ?></h3>

                <p>Exco Members</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="view_exco.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div> <!-- /.row -->

    </div> <!-- /.card-body -->
    </div>  <!-- /.card -->
    </div>  <!-- /.col rigth -->
    </div>  <!-- /.row -->

    <div class="row">
        <div class="col-md-6">    
        <!-- PIE CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Gender Distribution of Members</h3>

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
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div> <!-- /.card -->

        </div>  <!-- /.col (LEFT) -->
          
      <div class="col-md-6">

      <!-- BAR CHART -->
      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Demographic Distribution of Members</h3>

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
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div> <!-- /.card-body -->
            </div>  <!-- /.card -->
           </div><!-- /.col Right -->
      </div>  <!-- /.row -->
      
      <div class="row">
      <div class="col-md-6">
           <!-- Map card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-map-marker-alt mr-1"></i>
                  Zonal Distribution of members
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
              <canvas id="geoPolZone" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
                    </div><!-- col-md-6 -->
            <div class="col-md-6">

            <!-- Map card -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  States Distribution of members
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
              <div style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;">
                        <?php include('map.php'); ?>
              </div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

            </div><!-- col-md-6 -->
          
      </div><!-- Map Row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Super Admin</h5>
      <p>dashboard</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  


  <?php require('inc/dfooter.php'); ?>