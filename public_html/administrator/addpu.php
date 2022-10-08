<?php 
require('inc/config.php'); 
$page_title = 'Add Polling Unit';
include('inc/dheader.php');
include ('inc/functions.php');

//Redirect invalid user
if (!isset($_SESSION['user_id']) && !isset($_SESSION['phone']) && !isset($_SESSION['email'])) {	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}
if($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
    //need MYSQL
require(MYSQL);

    $success_message ="";
    $error_message   ="";

  // Trim all the incoming data:
  $trimmed = array_map('trim', $_POST);
   
   // Check for a Ward:
    if ($trimmed['ward_id']){
        $ward_id = mysqli_real_escape_string ($dbc, $trimmed['ward_id']);
    }else {
        $error_message  = '<label class= "text-danger">You must select Ward</lable>';
    }
   
   // Check for new Polling Unit
    if ($trimmed['pu_id']){
        $pu_id = mysqli_real_escape_string ($dbc, $trimmed['pu_id']);
    } else {
        $error_message =  '<label class= "text-danger">Polling  Unit Field cannot be empty';
    }
   
    $pu_array = explode("\r\n",$pu_id);

    

    $pu =  $pu_array;
   
    $pu2 = implode(" ",$pu);

                //if everything is ok register the PU
            if ($ward_id && $pu) { // If everything's OK...          
        
            // Make sure the PU is not in the database alreadyr:
        $q = "SELECT ward_id, pu_name FROM polling_unit WHERE pu_name ='$pu2' AND ward_id ='$ward_id'";
        $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));        
          if (mysqli_num_rows($r) == 0) { // Not registered.        
                    // Add the PU to the database:
    foreach ($pu_array as  $value) {
            $q = "
            INSERT INTO polling_unit (ward_id, pu_name) 
            VALUES ('$ward_id', '".implode("'),('",$pu)."' )
            ";
            $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
    }         
                        
    
    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
                            $error_message = "<lable class='text-success'>Polling Unit Inserted Successfully </label>";

                        }else { // If it did not run OK.
                            $error_message = "<p class='text-success'>Polling Unit could not be Inserted due to a system error. We apologize for any inconvenience</p>";
                           
                        
                        }
                 
               
               }else { // The PU is not available.
                $error_message = "<p class='text-danger'>That polling unit has already been registered!</p>";
                    

                     }

        }else { // If one of the data tests failed.
            $error_message = "<p class='text-danger'>Something went wrong, please try again</p>";
             
        }
  
        mysqli_close($dbc); 

} //End Server Request Method Check
            

?>
    <!-- Main content -->
<div class="content">
      <div class="container-fluid">
      <div class="row">
                <div class="col-lg-6 col-12">
                    <h3> <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    echo $error_message; 
                    }
                    //need MYSQL
                    require(MYSQL);
                    ?></h3>
                        <div class="styled-form register-form">
                            <form method="post" action="addpu.php">


     
              <div class="form-group">
                <label for="lga">Select LGA</label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                    <select name="lga_id" class="form-control" id="lga-dropdown">
                    <option value="">Select Local Government</option>
                    <?php
                    $q = "SELECT lga_id, lga_name FROM lga ORDER BY lga_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['lga_id'];?>"><?php echo $row["lga_name"];?></option>
                    <?php
                    }
                    ?>                           
                    </select>
               </div>


                
                <div class="form-group">
                    <label for="ward">Select Ward</label>
                    <select class="form-control" id="ward-dropdown" name = "ward_id">
                    </select>                     
               </div>

               <div class="form-group">
                    <label for="pu">Check if Polling Units Exist</label>
                    <select class="form-control" id="pu-dropdown">
                    </select>                     
               </div>


               
               <div class="form-group">
                    <label for="pu"> Add New Polling Unit(s)</label>
                    <textarea name="pu_id" cols="20" rows="10" class="form-control"></textarea>                               
               </div>


      
               <div class="form-group pull-left">         
                    <button type="submit" class="thm-btn thm-tran-bg btn-primary btn-lg btn-block">Submit</button>
              </div>
                
                        
        </form> </div> <!-- Form div -->
                    
                </div><!-- End Col-md-12 -->

        </div> <!-- /.row -->

  

     
   
      </div><!-- /.container-fluid -->
    </div>   <!-- /.content -->
  </div>  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->


  <?php
   require('inc/dfooter.php');   
    
   ?>