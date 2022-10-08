<?php # - header.html
// Start output buffering:
ob_start();

// Initialize a session:
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php if(isset($page_title)){  echo $page_title;}else{ echo "Like Minds For Peter Obi";} ?></title> 

	
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css"> 
    <link rel="stylesheet" href="css/bootstrap-select-country.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">


    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="images/favicon/favicon-16x16.png" sizes="16x16">

 

</head>
<body>

<div class="boxed_wrapper">

<?php // detect mobile and display  APP download badge
include 'inc/mobile/Mobile_Detect.php';
$detect = new Mobile_Detect();

if ($detect->isMobile()) {
    //do'nt show top menu items
}else{

    echo'<header class="top-bar">
    <div class="container">
        <div class="clearfix">
            <ul class="top-bar-text float_left">
                <li><i class="icon-technology-1"></i>Phone +2348093061362</li>
                <li><i class="icon-note"></i>crossriver@likeminds4peterobi.com</li>
                <li><i class="icon-world"></i>Calabar, CRS, Nigeria</li>
            </ul>
            <ul class="social float_right">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-telegram" aria-hidden="true"></i></a></li>
            </ul>
        </div>
            

    </div>
</header>';
}
?>


<section class="theme_menu stricky">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="main-logo">
                    <a href="/"><img src="images/logo/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-md-9 menu-column">
                <nav class="menuzord" id="main_menu">
                   <ul class="menuzord-menu">
                           <!-- <li><a href="index.php">Home</a></li>
                        <li><a href="features.php">Features</a></li>                        
                        <li><a href="shop.php">Experts</a></li> 
                        <li><a href="download.php">Download</a></li> 
                        <li><a href="https://www.blog.littledavidea.com/">Blog</a></li>
                        <li><a href="lab.php">ForexLab</a></li>
                        <li><a href="faq.php">FAQ's</a></li>   
                        <li><a href="contact.php">Contact us</a></li>-->
                    </ul><!-- End of .menuzord-menu -->
                </nav> <!-- End of #main_menu -->
            </div>
            <div class="right-column">
                <div class="right-area">
                    
                   <div class="link_btn float_right">
                       <a href="#survey" class="thm-btn">Join Us</a>
                   </div>
                </div>
                    
            </div>
        </div>
                

   </div> <!-- End of .conatiner -->
</section> 