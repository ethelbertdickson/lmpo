<?php 
require('inc/config.php'); 
$page_title = "Register";
include('page_header.php');
include ('inc/functions.php');
Register_New_User();

 echo'<div class="container col-md-4" align ="center" style="padding-top:20px;" >';
          echo '<a class="btn link_btn btn-lg btn-block" href="login.php">LOG IN</a>';
          echo'</div>';


          
 require('footer.php'); 

 ?>