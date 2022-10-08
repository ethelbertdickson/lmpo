<?php #  - logout.php
require ('inc/config.php'); 
$page_title = 'Logout';
include('header.php');

// If no first_name and user_id session variable exists, redirect the user:
if (!isset($_SESSION['user_id']) && !isset($_SESSION['email']) ) {
	$url = BASE_URL; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}else{ //  Log out the user.
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-3600); // Destroy the cookie.
}
// Print a customized message:
echo '<script> swal("Spoky!", "You are now logged out.", "success");</script>';
//  redirect the user to login page:
if (!isset($_SESSION['user_id']) && !isset($_SESSION['email'])) {
	$url = BASE_URL .'login.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}
?>