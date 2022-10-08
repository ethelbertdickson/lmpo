<?php 
require('inc/config.php'); 
$page_title = "Register";
include('page_header.php');
include ('inc/functions.php');
?>

<section class="register-section sec-padd">
    <div class="container">
        <div class="row">
            
          
            <!--Form Column-->
            <div class="form-column column col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <div class="section-title">
                    <h3>Register Now</h3>
                    <div class="decor"></div>
                </div>
                
                <!--Login Form-->
                <div class="styled-form register-form">
                    <form method="post" action="reg.php">
                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-user"></span></span>
                        <input id="fname" placeholder="First Name" type="text" class="form-control" name="first_name" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" required autofocus>
                               
                        </div>

                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-user"></span></span>
                        <input id="lname" placeholder="Last Name" type="text" class="form-control" name="last_name" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" required autofocus>     
                        </div>
                        

                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                            <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email'];?>"  required>
                        </div>

                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-flag-alt"></span></span>
                            <select name="country" class="form-control">
                     <?php 
                        require(MYSQL);
                            // Retrieve the user's information:
                        $q = "SELECT country_id, name FROM countries  ORDER BY country_id ASC";        
                        $r = @mysqli_query ($dbc, $q);
                            // Get the countries information:
                            echo "<option >Select Country</option>";
                                while($row = mysqli_fetch_array ($r, MYSQLI_NUM)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }  
                                             
                           ?>
                      </select>

                        </div>

                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                            <input id="password" placeholder="Password" type="password" class="form-control" name="password1" required>
                        </div>


                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password2" required>
                        </div>





                        <div class="clearfix">
                            <div class="form-group pull-left">
                                <button type="submit" class="thm-btn thm-tran-bg">Register here</button>
                            </div>
                            <div class="form-group padd-top-15 pull-right">
                                * Already registered OR <a href="login.php" class="thm-btn">Login</a> 
                            </div>
                        </div>
                        
                    </form>
                </div>
                
            </div>
            
        </div>
    </div>
</section>



<?php
 require('footer.php'); 

 ?>