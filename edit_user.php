<?php 
require('inc/config.php'); 
$page_title = 'Edit Member';
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
if ($_SESSION['user_level'] <2  || $_SESSION['user_level'] >27 ) {	
    $url = BASE_URL . 'dashboard.php'; // Define the URL.
    ob_end_clean(); // Delete the buffer.
    header("Location: $url");
    exit(); // Quit the script. 
}

?>

 

<?php 
// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
    $id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
    $id = $_POST['id'];
} else { // No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    include ('includes/footer.php'); 
    exit();
}

require (MYSQL); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Trim all the incoming data:
$trimmed = array_map('trim', $_POST);   
    
// Check for a first name:
if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
    $fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
} else {
    echo '<h4>Please enter your first name!</h4>';
}

// Check for a last name:
if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
    $ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
} else {
    echo '<h4>Please enter your last name!</h4>';
}

// Check for an email address:
if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
    $e = mysqli_real_escape_string ($dbc, $trimmed['email']);
} else {
    $e = NULL;
}


 // Check for a Phone Number:
if ($trimmed['phone']){
    $tel = mysqli_real_escape_string ($dbc, $trimmed['phone']);
}  else {
    echo '<h4>Please enter a valid phone!</h4>';
}

// Check for a Phone Number:
if ($trimmed['pu_id']){
    $pu_id = mysqli_real_escape_string ($dbc, $trimmed['pu_id']);
} else {
    $pu_id = "NULL";
}

// Check for a Phone Number:
if ($trimmed['ward_id']){
    $ward_id = mysqli_real_escape_string ($dbc, $trimmed['ward_id']);
}else {
    $ward_id = "NULL";
}

 // Check for a Phone Number:
if ($trimmed['gender']){
    $gender = mysqli_real_escape_string ($dbc, $trimmed['gender']);
} else {
    echo '<h4>Please Choose your gender!</h4>';
} 


 // Check for a Phone Number:
    if ($trimmed['user_level']){
        $role = mysqli_real_escape_string ($dbc, $trimmed['user_level']);
    } else {
        echo '<h4>Please select user Role!</h4>';
    } 

   // Check for a Phone Number:
    if ($trimmed['support_group']){
        $support_group = mysqli_real_escape_string ($dbc, $trimmed['support_group']);
    } else {
        echo '<h4>Please Choose your support_group!</h4>';
    } 


     // Check for a Phone Number:
       if ($trimmed['state_id']){
            $state_id = mysqli_real_escape_string ($dbc, $trimmed['state_id']);
        } else {
            echo '<h4>Please Choose your state!</h4>';
        }  


     // Check for state of Origin:
       if ($trimmed['state_origin']){
            $state_origin = mysqli_real_escape_string ($dbc, $trimmed['state_origin']);
        } else {
            echo '<h4>Please Choose your state of Origin!</h4>';
        }  



         // Check for a Phone Number:
        if ($trimmed['pvc_status']){
            $pvc = mysqli_real_escape_string ($dbc, $trimmed['pvc_status']);
        } else {
            echo '<h4>Please let us know if you have PVC of not!</h4>';
        }


         // Check for a Phone Number:
        if ($trimmed['age_group']){
            $age_group = mysqli_real_escape_string ($dbc, $trimmed['age_group']);
        }  else {
            echo '<h4>Please select Age Grade!</h4>';
        }

         // Check for a Phone Number:
        if ($trimmed['lga_id']){
            $lga_id = mysqli_real_escape_string ($dbc, $trimmed['lga_id']);
        } 

// clean Phone Number
 $phone = str_replace("-","", $tel);
  //if everything is ok register the user
if ($fn && $ln && $e && $role && $phone && $state_id  && $state_origin && $support_group && $pu_id && $ward_id && $gender && $pvc && $lga_id && $age_group ) { // If everything's OK...

    
        //  Test for unique email address:
        $q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) == 0) {

    // Make the query:
    $q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', user_level ='$role', phone='$phone', state_id='$state_id', support_group='$support_group', lga_id='$lga_id', gender='$gender', pvc_status ='$pvc', age_group ='$age_group', pu_id='$pu_id', ward_id='$ward_id',  state_origin='$state_origin', updated_at= NOW() WHERE user_id = $id";
    $r = @mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
    // Print a message:
        echo '<h3  class="alert alert-success">This user has been edited  successfully!</h3>';   
                 
            } else { // If it did not run OK.
                echo '<p  class="alert alert-danger">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
                echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
            }
                
        } else { // Already registered.
            echo '<p class="error">The email address has already been registered.</p>';

    
    }
    
  }else { // Report the errors.    

        echo '<p class="error">Some error(s) occurred:<br />';
        echo '</p><p>Please try again.</p>';
    
    } // End of if (empty($errors)) IF.

} // End of submit conditional.

?>


<?php
// Retrieve the user's information:
$q = "SELECT  COALESCE(state_origin, 1), state_id, lga_id, ward_id, pu_id, support_group, age_group, gender, coalesce(user_level, 1), COALESCE(religion_id, 1), first_name, last_name, phone, email, pvc_status FROM users WHERE user_id=$id";       
$r = @mysqli_query ($dbc, $q);
if (mysqli_num_rows($r) >0) { // Valid user ID, show the form.
    // Get the user's information:
 $row = mysqli_fetch_array ($r, MYSQLI_NUM);
 
 $state_of_origin = $row[0];
 $voting_state    = $row[1];
 $voting_lga      = $row[2];
 $voting_ward     = $row[3];
 $voting_pu       = $row[4];
 $support_group   = $row[5];
 $age_grade       = $row[6];
 $sex             = $row[7];
 $level           = $row[8];
 $ureligion       = $row[9];
 $ufirst_name     = $row[10];
 $ulast_name      = $row[11];
 $uphone          = $row[12];
 $uemail          = $row[13];
 $voter_status    = $row[14];





// Retrieve the user's voting state:
$check_state = "SELECT state_id, state_name FROM states WHERE state_id=$voting_state ";     
$query_state = @mysqli_query ($dbc, $check_state);

if(mysqli_num_rows($query_state) == 1){

   // Get the user's information:
 $row = mysqli_fetch_array ($query_state, MYSQLI_NUM);
  $users_voting_state_id = $row[0];
  $users_voting_state    = $row[1];

}


// Retrieve the user's state:
$check_state = "SELECT state_id, state_name FROM states WHERE state_id=$state_of_origin  ";     
$query_state = @mysqli_query ($dbc, $check_state);

if(mysqli_num_rows($query_state) == 1){
   // Get the user's information:
 $row = mysqli_fetch_array ($query_state, MYSQLI_NUM);

  $users_state_of_origin_id = $row[0];
  $users_state_of_origin    = $row[1];


}else{
  $users_state_of_origin_id = $users_voting_state_id;
  $users_state_of_origin    = $users_voting_state;
}



// Retrieve the user's voting lga:
$check_lga = "SELECT lga_id, lga_name FROM lga WHERE lga_id=$voting_lga ";     
$query_lga = @mysqli_query ($dbc, $check_lga);

if(mysqli_num_rows($query_lga) == 1){

   // Get the user's information:
 $row = mysqli_fetch_array ($query_lga, MYSQLI_NUM);
  $users_voting_lga_id = $row[0];
  $users_voting_lga = $row[1];

}


// Retrieve the user's voting ward:
$check_ward = "SELECT ward_id, ward_name FROM ward WHERE ward_id LIKE '$voting_ward%' ";     
$query_ward = @mysqli_query ($dbc, $check_ward);

if(mysqli_num_rows($query_ward) == 1){

   // Get the user's information:
 $row = mysqli_fetch_array ($query_ward, MYSQLI_NUM);

  $users_voting_ward_id = $row[0];
  $users_voting_ward    = $row[1];

}


// Retrieve the user's voting pu:
$check_pu = "SELECT pu_id, pu_name FROM polling_unit WHERE pu_id LIKE '$voting_pu%' ";     
$query_pu = @mysqli_query ($dbc, $check_pu);

if(mysqli_num_rows($query_pu) == 1){

   // Get the user's information:
 $row = mysqli_fetch_array ($query_pu, MYSQLI_NUM);

  $users_voting_pu_id = $row[0];
  $users_voting_pu    = $row[1];

}


// Retrieve the user's  support_group:
$check_support_group = "SELECT support_group_id, support_group_name FROM support_group WHERE support_group_id=$support_group ";     
$query_support_group = @mysqli_query ($dbc, $check_support_group);

if(mysqli_num_rows($query_support_group) == 1){

   // Get the user's information:
 $row = mysqli_fetch_array ($query_support_group, MYSQLI_NUM);

  $users_support_group_id = $row[0];
  $users_support_group    = $row[1];

}


// Retrieve the user's  religion:
$check_religion = "SELECT religion_id, religion_name FROM religion WHERE religion_id=$ureligion ";     
$query_religion = @mysqli_query ($dbc, $check_religion);

if(mysqli_num_rows($query_religion) == 1){
   // Get the user's information:
 $row = mysqli_fetch_array ($query_religion, MYSQLI_NUM);

  $users_religion_id = $row[0];
  $users_religion    = $row[1];

}else{
  $users_religion_id = 1;
  $users_religion    = "Christian";
}


// Retrieve the user's  rank:
$check_rank = "SELECT rank_id, rank_name FROM rank WHERE rank_id=$level ";     
$query_rank = @mysqli_query ($dbc, $check_rank);

if(mysqli_num_rows($query_rank) == 1){

   // Get the user's information:
 $row = mysqli_fetch_array ($query_rank, MYSQLI_NUM);

  $users_rank_id = $row[0];
  $users_rank    = $row[1];

}else{
  $users_rank_id = 1;
  $users_rank    = "Regular";
}




$user_age_grade = $age_grade;
//determine cateory of users
switch($user_age_grade) {
   case 1:
       $user_age_grade = "18-24";
       break;
   case 2:
       $user_age_grade = "25-30";
       break; 
   case 3:
       $user_age_grade = "31-35";
       break; 
    case 4:
    $user_age_grade    = "36-40";

    case 5:
       $user_age_grade = "41-45";
       break;

    case 6:
       $user_age_grade = "46-50";
       break; 
    case 7:
       $user_age_grade = "51-55";
       break;

    case 8:
       $user_age_grade = "56-60";
       break;

    case 9:
       $user_age_grade = "61-65";
       break;

    case 10:
       $user_age_grade = "66-70";
       break; 
    case 11:
       $user_age_grade = "25-30";
       break;    
   default:
       $user_age_grade = "70+";
       break;
}//end switch

}

?>

<!-- Main content -->
<div class="content">
      <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">    
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><?php echo "$ulast_name, $ufirst_name Information"; ?></h3>

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


              <div class="container">
        
          <!--Login Form-->
                <div class="styled-form register-form" style= "margin-top: 20px;">
                    <form method="post" action="">

                <div class="col-lg-6 col-md-6 ">
                        <div class="form-group">
                        <label for="fname">First Name</label>
                            <span class="adon-icon"><span class="fa fa-user"></span></span>
                        <input id="fname" value="<?php echo($ufirst_name); ?>"  type="text" class="form-control" name="first_name"  required >
                               
                        </div>

                        <div class="form-group">
                        <label for="lname">Last Name</label>
                            <span class="adon-icon"><span class="fa fa-user"></span></span>
                        <input id="lname" value="<?php echo($ulast_name); ?>" type="text" class="form-control" name="last_name"  required >     
                        </div>
                        

                        <div class="form-group">
                        <label for="email">Email Address</label>
                            <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                            <input id="email" type="email" value="<?php echo($uemail); ?>" class="form-control" name="email" >
                        </div>

                        <div class="form-group">
                        <label for="phone">Phone Number (<small>Format: 2348011234567</small>)</label>
                            <span class="adon-icon"><span class="fa fa-phone"></span></span>
                            <input id="phone" value="<?php echo($uphone); ?>" type="tel" class="form-control" name="phone"  required>
                        </div>



                         <div class="form-group">
                <label for="age">Age Grade</label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                            <select id="age" name="age_group" class="form-control">
                                <option value="<?php echo $age_grade; ?>"><?php echo $user_age_grade; ?></option> 
                                <option value="1">18-24</option>                            
                                <option value="2">25-30</option>
                                <option value="3">31-35</option>
                                <option value="4">36-40</option>
                                <option value="5">41-45</option>
                                <option value="6">46-50</option>
                                <option value="7">51-55</option>
                                <option value="8">56-60</option>
                                <option value="9">61-65</option>
                                <option value="10">66-70</option>
                                <option value="11">70+</option>
                            </select>
                        </div>

            <div class="form-group">
                <label for="rank">User Role</label>
                            <select id="user_level" name="user_level" class="form-control" <?php if($_SESSION['user_level'] != 2) echo "disabled"; ?>	 >
                            <option value="<?php echo $users_rank_id; ?>"><?php echo $users_rank; ?></option> 
                                <?php
                    $q = "SELECT rank_id, rank_name FROM rank WHERE rank_id != $users_rank_id  ORDER BY rank_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['rank_id'];?>"><?php echo $row["rank_name"];?></option>
                    <?php
                    }
                    ?>  
                     </select>
              </div>


                        <div class="form-group">
                <label for="state"> State Of Origin</label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                    <select name="state_origin" class="form-control" id="state_origin">
                    <option value="<?php echo $users_state_of_origin_id; ?>"><?php echo $users_state_of_origin; ?></option>
                    <?php
                    $q = "SELECT state_id, state_name FROM states WHERE state_id != $users_state_of_origin_id ORDER BY state_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['state_id'];?>"><?php echo $row["state_name"];?></option>
                    <?php
                    }
                    ?>                           
                    </select>
               </div>  


                       
               
                        
                                

                        
    </div><!-- End first column -->

    <div class="col-lg-6  col-md-6 ">               

         <div class="form-group">
                <label for="state">Voting State</label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                    <select name="state_id" class="form-control" id="state-dropdown">
                    <option value="<?php echo  $users_voting_state_id; ?>"><?php echo $users_voting_state; ?></option>
                    <?php
                    $q = "SELECT state_id, state_name FROM states WHERE state_id != $users_voting_state_id ORDER BY state_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['state_id'];?>"><?php echo $row["state_name"];?></option>
                    <?php
                    }
                    ?>                           
                    </select>
               </div>  


               <div class="form-group">
                <label for="lga">current LGA:<em><?php echo   $users_voting_lga;  ?></em> </label>
        <select name="lga_id" class="form-control" id="lga-dropdown">
                    <option value="<?php echo $users_voting_lga_id; ?>"><?php echo $users_voting_lga; ?></option>
                    <?php
                    $q = "SELECT lga_id, lga_name FROM lga WHERE state_id =$users_voting_state_id AND  lga_id != $users_voting_lga_id  ORDER BY lga_id ASC";
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
                    <label for="ward"> Current Ward:<em><?php echo   $users_voting_ward; ?></em></label>
                    <select name="ward_id" class="form-control" id="ward-dropdown">
                    <option value="<?php echo $users_voting_ward_id; ?>"><?php echo $users_voting_ward; ?></option>
                    <?php
                    $q = "SELECT ward_id, ward_name FROM ward WHERE ward_id LIKE '%-$users_voting_lga_id-%' AND  ward_id != $users_voting_ward_id   ORDER BY ward_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['ward_id'];?>"><?php echo $row["ward_name"];?></option>
                    <?php
                    }
                    ?>                           
                    </select>                     
               </div>

               <div class="form-group">
        
                    <label for="pu">Current Polling Unit:<em> <?php echo $users_voting_pu; ?></em></label>
                    <select class="form-control" id="pu-dropdown" name ="pu_id">
					<option value="<?php echo $users_voting_pu_id; ?>"><?php echo $users_voting_pu; ?></option>   
					 <?php
                    $q = "SELECT pu_id, pu_name FROM polling_unit WHERE pu_id LIKE '$users_voting_ward_id-%' AND  pu_id != $users_voting_pu_id   ORDER BY pu_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['pu_id'];?>"><?php echo $row["pu_name"];?></option>
                    <?php
          }
          ?>
                    </select>                     
               </div>            


               
                
                <div class="form-group">
                <label for="support_group">Select Sub-group </label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                            <select id="support_group" name="support_group" class="form-control">
                            <option value="<?php echo $users_support_group_id; ?>"><?php echo $users_support_group; ?></option> 
                                <?php
                    $q = "SELECT support_group_id, support_group_name FROM support_group  ORDER BY support_group_id ASC";
                    $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
                    while($row = mysqli_fetch_array($r)) {
                    ?>
                    <option value="<?php echo $row['support_group_id'];?>"><?php echo $row["support_group_name"];?></option>
                    <?php
                    }
                    ?>  
                            </select>
                        </div>

                        <div class="form-group">
                            <label for ="gender">Gender</label>
                            
                            <div class="radio">
                            <label for="male"> <input type="radio" id="male" <?php if($sex !=2) 
                echo'checked="checked"'; 
                ?> name="gender" value="1">Male</label>
                             </div>

                             <div class="radio">
                             <label for="female"><input type="radio" id="female" <?php if($sex !=1) 
                echo'checked="checked"'; 
                ?> name="gender" value="2">  Female</label>                           
                            </div>
                      
                        </div>

                        <div class="form-group">
                            <label for ="pvc">Are You A Registered & Eligible Voter?</label>
                            
                            <div class="radio">
                 <label for="yes"><input type="radio" id="yes" <?php if($voter_status !=2) echo'checked="checked"'; ?> name="pvc_status" value="1">Yes</label>
                            </div>

                           <div class="radio"> 
                           <label for="no"><input type="radio" id="no" <?php if($voter_status !=1) echo'checked="checked"'; ?> name="pvc_status" value="2">No</label>
                           </div>

                     </div>


        </div> <!-- End second form column --><br><br>

        

            <div class="col-lg-10 col-md-10">                      
                    <div class="col-lg-12 col-md-5">
                              <div class="form-group pull-left">
                                <button type="submit" class="btn-primary btn-block">Submit</button>
                           </div>
                    </div>
                           
             </div>
                        
                    </form> 
                </div>
        
</div> 



              </div>

        </div>
         </div>
        </div>

    </div>
</div>

        </div>

<?php
//close databse connection
mysqli_close($dbc);
include ('inc/dfooter.php'); 
 ?>