<?php 
require('inc/config.php'); 
$page_title = APP_NAME;
include('header.php');
include ('inc/functions.php');

  
if($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

  // Need the database connection:
    require(MYSQL);

    
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
        echo '<h4>Please enter a valid email address!';
    }

    // Check for a password and match against the confirmed password:
    if ($trimmed['password1']) {
        if ($trimmed['password1'] == $trimmed['password2']) {
            $p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
        } else {
            echo '<h4>Your password did not match the confirmed password!</h4>';
        }
    } else {
        echo '<h4>Please enter a valid password! <br/>Minimum of six characters is required</h4>';
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
      //if everything is ok register the user
    if ($fn && $ln && $e && $p && $tel && $pu_id && $ward_id && $gender && $pvc && $lga_id && $age_group ) { // If everything's OK...

        // Make sure the email address has not been used by another user:
        $q = "SELECT user_id FROM users WHERE phone='$tel'";
        $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
        
        if (mysqli_num_rows($r) == 0) { // Available.        
                    // Add the user to the database:
            $q = "INSERT INTO users (email, pass, first_name, last_name, phone,  pu_id, ward_id, gender, pvc_status, age_group, lga_id, created_at, updated_at) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$tel',  '$pu_id', '$ward_id', '$gender', '$pvc',  '$age_group', '$lga_id', NOW(), NOW() )";
            $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            
                
        // Finish the page:
         echo'<section class="about-faq sec-padd">'; 
          echo '<div class="container">';
          echo '<div class="row clearfix">';
          echo '<div align ="center">';
          echo '<h3>Thank You, Registration Successful!</h3><br/><br/>';
          echo '<a align ="center" class="thm-btn yellow-bg" href="index.php"> Return Home</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</section>';
          include ('footer.php'); // Include the HTML footer.
           exit(); // Stop the page.

                
            } else { // If it did not run OK.
                echo '<h4 align ="center"> You could not be registered due to a system error. We apologize for any inconvenience</h4>';
         echo'<div align ="center">';
          echo '<a class="thm-btn yellow-bg" href="index.php"><br> <br>Return</a>';
          echo'</div>';
                 include ('footer.php'); // Include the HTML footer.
                exit(); // Stop the page.
            }
            
        
        } else { // The email address is not available.
            echo '<h4 align ="center">That phone number has already been registered!</h4>';
            echo'<div align ="center">';
            echo '<a class="thm-btn yellow-bg" href="index.php"><br> <br>Return</a>';
            echo'</div>';
                include ('footer.php'); // Include the HTML footer.
                exit(); // Stop the page.
                
        }
        
    } else { // If one of the data tests failed.
        echo '<h4 align="center"> ("Something went wrong, please try again");</h4>';
        echo'<div align ="center">';
          echo '<a class="thm-btn yellow-bg" href="index.php"><br> <br>Return</a>';
          echo'</div>';
         include ('footer.php'); // Include the HTML footer.
         exit(); // Stop the page.
    }

    mysqli_close($dbc);

    } //

?>

<!--Start rev slider wrapper-->     
<section class="rev_slider_wrapper">
    <div id="slider1" class="rev_slider"  data-version="5.0">
        <ul>
            
            <li data-transition="fade">
                <img src="images/slider/1.jpg"  alt="" width="1920" height="550" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1" >
                
                <div class="tp-caption  tp-resizeme" 
                    data-x="left" data-hoffset="15" 
                    data-y="top" data-voffset="125" 
                    data-transform_idle="o:1;"         
                    data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
                    data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
                    data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
                    data-splitin="none" 
                    data-splitout="none"
                    data-responsive_offset="on"
                    data-start="700">
                    <div class="slide-content-box">
                        <h1 style=" text-shadow:  #ffffff;">Like Minds For Peter Obi <br/> Cross River State</h1>
                        <p style=" text-shadow: #036622;  font-size: 25px">Our choice of President should not be based on tribe, ethnicity, or religion. <br/>Let us vote for <em>EMPATHY, HUMILITY, SERVICE & PROVEN RECORD of good governance</em>.</p><br/><br/>
                    </div>
                </div>
                <div class="tp-caption tp-resizeme" 
                    data-x="left" data-hoffset="15" 
                    data-y="top" data-voffset="364" 
                    data-transform_idle="o:1;"                         
                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                    data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on"
                    data-start="2300">
                    <div class="slide-content-box">
                        <div class="button">
                            <a class="thm-btn yellow-bg" href="#survey">Join LMPO CRS </a>     
                        </div>
                    </div>
                </div>
                <div class="tp-caption tp-resizeme" 
                    data-x="left" data-hoffset="188" 
                    data-y="top" data-voffset="364" 
                    data-transform_idle="o:1;"                         
                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                    data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on"
                    data-start="2600">
                    <div class="slide-content-box">
                        <div class="button">
                            <a class="thm-btn our-solution" href="https://likeminds4peterobi.com">Goto HomePage</a>          
                        </div>
                    </div>
                </div>
            </li>
          
            
        </ul>
    </div>
</section>
<!--End rev slider wrapper--> 

<!--Fact Counter-->
<section class="fact-counter sec-padd">
    <div class="container">
        <div class="row clearfix">
            <div class="counter-outer clearfix">
                <!--Column-->
                <article class="column counter-column col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                    <div class="item">
                        <?php 
                            // need database connection
                        require(MYSQL);

                        // Define the query to determine the total number of  registered users:
                        $q = "SELECT first_name, last_name, phone FROM users WHERE state_id =9 ";     
                        $r = @mysqli_query ($dbc, $q); // Run the query.
                        // Count the number of returned rows:
                        $num = mysqli_num_rows($r);


                         $q1 = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='1' AND state_id =9";     
                        $r1 = @mysqli_query ($dbc, $q1); // Run the query.
                        // Count the number of returned rows:
                        $num1 = mysqli_num_rows($r1);

                         $q2 = "SELECT first_name, last_name, phone FROM users WHERE pvc_status ='2'AND state_id =9 ";     
                        $r2 = @mysqli_query ($dbc, $q2); // Run the query.
                        // Count the number of returned rows:
                        $num2 = mysqli_num_rows($r2);
                        ?>
                        <div class="count-outer"><span class="count-text" data-speed="2500" data-stop="<?php if ($num > 0) { // If it ran OK, display the records.
                        echo $num ;
                        }
                        ?>">0</span></div>
                        <h4 class="counter-title">Members</h4>
                    </div>
                        
                </article>
                
                <!--Column-->
                <article class="column counter-column col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                    <div class="item">
                        <div class="count-outer"><span class="count-text" data-speed="2500" data-stop="<?php if ($num1 > 0) { // If it ran OK, display the records.
                        echo $num1 ;
                        }
                        ?>">0</span></div>
                        <h4 class="counter-title">Members with PVC</h4>
                    </div>
                </article>
                
                <!--Column-->
                <article class="column counter-column col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                    <div class="item">
                        <div class="count-outer"><span class="count-text" data-speed="2500" data-stop="<?php if ($num2 > 0) { // If it ran OK, display the records.
                        echo $num2 ;
                        }
                        ?>">0</span></div>
                        <h4 class="counter-title">Members without PVC</h4>
                    </div>
                </article>                
                
            </div>
        </div>
    </div>
</section>

<!--End rev slider wrapper--> 
<section class="testimonials-section sec-padd" id="survey">
    <div class="container">
        <div class="section-title center">
            <h2>Join The Campaign</h2>
        </div> 

          <!--Login Form-->
                <div class="styled-form register-form">
                    <form method="post" action="index.php">

                <div class="col-lg-6 col-md-6 ">
                        <div class="form-group">
                        <label for="fname">First Name</label>
                            <span class="adon-icon"><span class="fa fa-user"></span></span>
                        <input id="fname" placeholder="First Name" type="text" class="form-control" name="first_name"  required >
                               
                        </div>

                        <div class="form-group">
                        <label for="lname">Last Name</label>
                            <span class="adon-icon"><span class="fa fa-user"></span></span>
                        <input id="lname" placeholder="Last Name" type="text" class="form-control" name="last_name"  required >     
                        </div>
                        

                        <div class="form-group">
                        <label for="email">Email Address</label>
                            <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                            <input id="email" type="email" placeholder="Email Address" class="form-control" name="email"   required>
                        </div>

                        <div class="form-group">
                        <label for="phone">Phone Number</label>
                            <span class="adon-icon"><span class="fa fa-phone"></span></span>
                            <input id="phone" placeholder="Phone" type="text" class="form-control" name="phone" required>
                        </div>


                         <div class="form-group">
                            <label for ="gender">Gender</label>
                            
                            <div class="radio">
                            <label for="male"><input type="radio" id="male" name="gender" value="1">Male</label>
                             </div>

                             <div class="radio">
                             <label for="female"><input type="radio" id="female" name="gender" value="2">  Female</label>                           
                            </div>
                      
                        </div>                      

                        
            </div><!-- End first column -->

    <div class="col-lg-6  col-md-6 ">
                <div class="form-group">
                <label for="lga">LGA</label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                    <select name="lga_id" class="form-control" id="lga-dropdown">
                    <option value="">Select Local Government</option>
                    <?php
                    $q = "SELECT lga_id, lga_name FROM lga WHERE state_id=9 ORDER BY lga_id ASC";
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
                    <label for="ward">Ward</label>
                    <select class="form-control" id="ward-dropdown" name = "ward_id">
                    </select>                     
               </div>

               <div class="form-group">
                    <label for="pu">Polling Unit</label>
                    <select class="form-control" id="pu-dropdown" name ="pu_id">
                    </select>                     
               </div>

                

                <div class="form-group">
                <label for="age">Age</label>
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                            <select id="age" name="age_group" class="form-control">
                                <option value="0">Choose Your Age Grade</option> 
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
                                <option value ="11">70+</option>
                            </select>
                        </div>


                <div class="form-group">
                            <label for ="pvc">Do You Have PVC?</label>
                            
                            <div class="radio">
                            <label for="yes"><input type="radio" id="yes" name="pvc_status" value="1">Yes</label>
                            </div>

                           <div class="radio"> 
                           <label for="no"><input type="radio" id="no" name="pvc_status" value="2">No</label>
                           </div>

                </div>  


        </div> <!-- End second form column --><br><br>

        

            <div class="col-lg-10 col-md-10">
                    <div class="col-lg-8 col-md-8">
                        <div class="form-group">
                             <!--<span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>-->
                            <input id="password"  value="Obi4BetterNigeria" type="hidden" class="form-control" name="password1" required>
                        </div>


                        
                            <div class="form-group">
                            <!--<span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>-->
                            <input id="password_confirm" value="Obi4BetterNigeria" type="hidden" class="form-control" name="password2" required>
                        </div>
                    </div>

                        
                    <div class="col-lg-12 col-md-12">
                              <div class="form-group pull-left">
                                <button type="submit" class="thm-btn thm-tran-bg btn-block">Submit</button>
                           </div>
                    </div>
                           
        </div>
                        
                    </form> </div>
             
        
</div>    
</section>



<section class="about-faq sec-padd">
    <div class="container">


        <div class="section-title center">
            <h2>Join The Campaign for Good Governance</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                
                <div class="about-info">
                <h4>Welcome to Like Minds for Peter Obi (LM4PO) CRS</h4>
                    <br>
                
                    
                    
                    <div class="text">                      

<p>Like Minds for Peter Obi (LM4PO) is an initiative helping to strengthen, stabilize, mobilize, and promote activities, persons/groups involved in the important work of delivering the message of #PeterIsBetter to every eligible voter in Nigeria. Hence the creation of this platform to share ideas, strategies and mobilize every resources needed to actualize the election of Peter Obi as the President of Nigeria come 2023.</p> 

<p>The task before us is daunting but surmountable with our commitment to this project to change the status quo in our the leadership recruitment process in our nation where mediocrity is elevated above competency. Let's rise up and be counted as true Patriot in Nigeria's rescue.</p> 

<p>This group is strictly for the promotion, dissemination of information with regards to our principal's presidential project, so every resources/materials shared here should be such that seeks to promotes Peter Obi candidacy. We therefore appeal to everyone to adhere strictly to the group’s aims and objectives.</p> 

<p><em>THE TIME TO CHANGE THE NARRATIVE IS NOW!</em>
The future of Nigeria is in our hands, support Peter Obi for 2023 presidency project.  Join us today for a better tomorrow.</p>
<br>
                       <br>
                    </div>

                    <div class="link_btn">
                        <a href="#survey" class="thm-btn">Join Us Now</a>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                 <div class="about-info">
                <h4>Contact LGA Coordinators</h4>
                    <br>
                </div>
                <div class="accordion-box">
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Abi Local Government Area</p>
                            <div class="toggle-icon">
                                <span class="plus fa fa-angle-right"></span><span class="minus fa fa-angle-down"></span>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text">
                                <p><strong>Name: Valentine Onuora</strong><br/>
                                    Phone: 09066342584<br/>
                                <a  class= "thm-btn" href="https://chat.whatsapp.com/I4dTJX0dxsfGVWW3Tt7as1">Join WhatsApp Group</a></p>
                        </div>
                        </div>
                    </div>
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Akamkpa Local Government Area</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content collapsed">
                            <div class="text"><p> <strong>Name:Ephraim Asiya</strong> <br/> Phone: 08035593897  <br/>
                            <a href="https://chat.whatsapp.com/Gjm8sBzEuu60hHz3LRmrmi" class="thm-btn">Join WhatsApp Group </a>  </p>
                            </div>
                        </div>
                    </div>
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Akpabuyo Local Government Area</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Evang. Bassey Umo </strong><br> Phone: +2347080735451
                            <br>  <a href="https://chat.whatsapp.com/HAunHC0C07m35vC4MBSjVl" class="thm-btn">Join WhatsApp Group </a>  </p>
                            </p></div>
                        </div>
                    </div>

                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Bakassi Local Government Area</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Dominic Idara</strong><br/>
                            Phone: +2348064243836<br/>
                            <a href="https://chat.whatsapp.com/DUmuEMbeaQl8bqyWCtOqk5" class="thm-btn">Join WhatsApp Group </a>  </p>
                            
                            </p></div>
                        </div>
                    </div>
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Bekwarra Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Godwin Cletus </strong><br/>
                                Phone: 08086342233<br/>
                                <a href="https://chat.whatsapp.com/Ipz2PgIs1PN4ESAH5JAvhd" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Biase Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Kennedy Ekpezu </strong><br/>
                                Phone: 07031826442<br/>
                                <a href="https://chat.whatsapp.com/LHEmqMpNXHk3ER1fzAEZ3p" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Boki Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Paul Nyiam  </strong><br/>
                                Phone: 08063054975 <br/>
                                <a href="https://chat.whatsapp.com/BivT9Bz9u7w7Ijw9xIEIdj" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Calabar Municipal Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Ekong Etta  </strong><br/>
                                Phone:  +2347032099902<br/>
                                <a href="https://chat.whatsapp.com/J0IndJuqhWb0aMv1Sqvkeb" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Calabar South Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Ukeme Udo</strong><br/>
                                Phone:  07056497001 <br/>
                                <a href="https://chat.whatsapp.com/Ia2CAhDGz9KIao3emv1RBh" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

    

             <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Etung Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Ndoma Nsor Agbor </strong><br/>
                                Phone:  – 08065103801, 09161980095, 08059342890 <br/>
                                <a href="https://chat.whatsapp.com/J6o5Vz4vGUq2ITKzirB03m" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                     <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Ikom Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Peter Elijah </strong><br/>
                                Phone: 08067166680  <br/>
                                <a href="https://chat.whatsapp.com/HcK4hJG3zoa9OE9K6xLxdc" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                     <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Obanliku Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Prince Simeon Adi </strong><br/>
                                Phone:  08134716695 <br/>
                                <a href="https://chat.whatsapp.com/E62rTm04KAsAmJGmHzobJw" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                     <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Obubra Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Godspower Abeng </strong><br/>
                                Phone:  07056497001 <br/>
                                <a href="https://chat.whatsapp.com/Joh8bSSs0bs4Q9VfOqsf95" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

                      <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Obudu Local Government Area</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Okaba Augustine </strong>
                                <br/>Phone:  08143123700 <br/>
                                <a href="#" class="thm-btn">Join WhatsApp Group</a> 

                            </p></div>
                        </div>
                    </div>

                   
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Odukpani Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Billie Asuquo  </strong><br/>
                                Phone: 08052368499 <br/>
                                <a href="https://chat.whatsapp.com/Lc231sQ16LUCiGvGbruScl" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>
                  


                   <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Ogoja Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Ashaba Daniel Udejor </strong><br/>
                                Phone: 09091937150, 09060477808  <br/>
                                <a href="https://chat.whatsapp.com/LfPayCbO1eGAQGcvMqtGPi" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>
                      



                   <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Yakurr  Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Ubana Jephthah</strong><br/>
                                Phone:07040757169  <br/>
                                <a href="https://chat.whatsapp.com/CnyS9zs3NOSLuPO4fDkoWE" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>


                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Yala  Local Government Area </p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p><strong>Name: Peter Ofoboche </strong><br/>
                                Phone: 08038060160  <br/>
                                <a href="https://chat.whatsapp.com/KD8yk15nlJo4GTn4pGOT5U" class="thm-btn">Join WhatsApp Group</a> 
                            </p></div>
                        </div>
                    </div>

 



                </div>
            </div>
            
        </div>
    </div>
</section>

<div class="container"><div class="border-bottom"></div></div>

<?php require('footer.php'); ?>