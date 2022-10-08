<?php 
require('inc/config.php'); 
$page_title = 'State Dashboard';
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
   <?php
      //need MYSQL
                        require(MYSQL);
                       // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
                         AND state_id = 9 ";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $new_members = mysqli_num_rows($r); // Count the number of returned rows:
                    }else{
                      $new_members = 0;
                    }


                       // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM lga WHERE state_id = 9";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_lga = mysqli_num_rows($r); // Count the number of returned rows:
                    }


                        // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM ward  WHERE state_id = 9";     
                       $r = @mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                       
                    if (mysqli_num_rows($r) > 0) { // Available. 
                       $num_ward = mysqli_num_rows($r); // Count the number of returned rows:
                    }


                        // Define the query to determine the total number of  registered users:
                       $q = "SELECT * FROM polling_unit  WHERE state_id = 9";     
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
                        $male = mysqli_num_rows($r);
                        }


                       $q = "SELECT first_name, last_name, phone FROM users WHERE user_level > 1  ";     
                       $r = @mysqli_query ($dbc,$q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); // Run the query.
                        
                        if (mysqli_num_rows($r) > 0) { // Available. 
                        // Count the number of returned rows:
                        $female = mysqli_num_rows($r);
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
                <h3 class="card-title">Statewide  Statistics</h3>

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
              <a href="#" class="small-box-footer"> More Info &rarr;<i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="lga_users.php" class="small-box-footer">More info  <i class="fas fa-arrow-circle-right"></i></a>
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
                <h3><i class="fas fa-users"></i><?php echo " ".$male; ?></h3>

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
                <h3><i class="fas fa-users"></i><?php echo " ".$female; ?></h3>

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

    <div class="row">
        <div class="col-md-6">    
        <!-- PIE CHART -->
            <div class="card card-danger">
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
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">
                  Distribution of Members by Local Government
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
              <canvas id="word-map" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                   Distribution of members by Wards
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
              <canvas id="word-map" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
      <h5>Title</h5>
      <p>Sidebar content for dashboard</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
<script>
  $(function(){
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = <?php echo json_encode($lga); ?>
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>



  <?php require('inc/dfooter.php'); ?>