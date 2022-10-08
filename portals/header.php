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
  


    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="images/favicon/favicon-16x16.png" sizes="16x16">


<style>
    .center {
  margin: auto;
  width: 50%;
  padding-top: 30px;
}
</style>
 

</head>
<body>
<div class="boxed_wrapper">


 