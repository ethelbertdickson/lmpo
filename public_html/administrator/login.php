<?php # - login.php
require('inc/config.php'); 
$page_title = 'Login To '.APP_NAME;
include('header.php');

//create login function 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require(MYSQL);
 
    
    // Validate the email address:
    if (!empty($_POST['email'])) {
        $e = mysqli_real_escape_string ($dbc, $_POST['email']);
    }else{    
        $e =  false;
        echo '<center class="container"><p class="alert alert-danger">Please enter your email Or Phone Number </p></center>';
       }

    
    
    // Validate the password:
    if (!empty($_POST['pass'])) {
        $p = mysqli_real_escape_string ($dbc, $_POST['pass']);
    } else {
        $p = FALSE;
        echo '<center class="container"><p class="alert alert-danger">Please enter your password!</p></center>';
    }
    
    if ($e && $p) { // If everything's OK.

        // Query the database:
        $q = "SELECT user_id,  first_name, last_name, email, user_level, phone FROM users WHERE (email='$e' OR phone='$e' AND pass=SHA1('$p') )";     
        $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
        
        if (@mysqli_num_rows($r) == 1) { // A match was  made.
                        
            // Register the values:
            $_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
            mysqli_free_result($r);

            // Redirect the user:
            $url = BASE_URL . 'dashboard.php'; // Define the URL.
            ob_end_clean(); // Delete the buffer.
            header("Location: $url");
            exit(); // Quit the script.
           }else{ // No match was made.
                    echo '<script> swal("Oops!", "Either the email address or password entered do not match those on file or you have not yet activated your account", "error");</script>';
             }          
        
      } else { // If everything wasn't OK.
        echo '<center class="container"><p class="alert alert-danger">Please try again.</p></center>';
    }
    
    mysqli_close($dbc);

} // End of SUBMIT conditional.

?>

<section class="register-section sec-padd">
    <div class="container">
        <div class="row">

 <!--Form Column-->
            <div class="form-column column col-lg-6 col-md-6 col-sm-12 col-xs-12">
            
                <div class="section-title">
                    <h3>Login Now</h3>
                    <div class="decor"></div>
                </div>
                
                <!--Login Form-->
                <div class="styled-form login-form">
                    <form method="post" action="login.php">
                        
                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                            <input type="email" name="email" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" required autofocus placeholder="Enter Email Address or Phone Number*">
                        </div>
                        <div class="form-group">
                            <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                            <input type="password" name="pass" value="" placeholder="Enter Password">
                        </div>
                        <div class="clearfix">
                            <div class="form-group pull-left">
                                <button type="submit" class="thm-btn thm-tran-bg">login now</button>
                            </div>
                            <div class="link_btn float_right">
                               <!-- OR <a href="register.php" class="thm-btn google-plus">Create New Account</a>-->
                            </div>
                        </div>
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                <input type="checkbox" id="remember-me"><label for="remember-me">&nbsp; Remember Me</label>
                            </div>
                            <div class="pull-right">
                                <!--<a href="#" class="forgot">Forgot Password?</a>-->
                            </div>
                        </div>
                        
                    </form>
                </div>
                
            </div>

     
        </div>
    </div>
</section>


<?php include ('footer.php'); ?>