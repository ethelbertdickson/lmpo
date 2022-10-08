<?php # - config.php
/* This script:
 * - define constants and settings
 * - dictates how errors are handled
 * - defines useful functions
 * - Stores URLs and URIs as constants.
 * - Author:  Joshua Ekpe
 * - Website: diginettechnologies.com
 * - Last modified: October 15, 2018
 */


// ********************************** //
// ************ SETTINGS ************ //

// Flag variable for school name:
define('APP_NAME', 'Like Minds for Peter Obi');

// Errors are emailed here:
$contact_email = 'joshuaekpe87@gmail.com'; 

// Determine whether we're working on a local server
// or on the real server:
$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if ($local) {

    // Always debug when running locally:
    $debug = TRUE;
    
    // Define the constants:
    define('BASE_URI', 'http://localhost/lmpocrs/');
    define('BASE_URL', 'http://localhost/lmpocrs/');
    // Location of the MySQL connection script:
    define('MYSQL', 'C:/xampp/htdocs/lmpocrs/inc/lmpo_db_connect.php');
    
} else {

    define('BASE_URI', 'http://crs.likeminds4peterobi.com/');
    define('BASE_URL', 'http://crs.likeminds4peterobi.com/');
    define('MYSQL', '/home/chimvaao/dbc/lmpo_db_connect2.php');
    
}
    
// Assume debugging is off. 
if (!isset($debug)) {
    $debug = FALSE;
}



// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set ('US/Eastern');

// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

    global $debug, $contact_email;
    
    // Build the error message:
    $message = "An error occurred in script '$e_file' on line $e_line: $e_message";

    // Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
    
    // Append $e_vars to the $message:
    $message .= print_r($e_vars, 1);
    
    if ($debug) { // Show the error.
    
        echo '<div class="error">' . $message . '</div>';
        debug_print_backtrace();
        
    } else { 

        // Log the error:
        error_log ($message, 1, $contact_email); // Send email.

        // Only print an error message if the error isn't a notice or strict.
        if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
            echo '<div class="error"><center> <!-- A System Error Occurred!!! Please try again later. --></center></div>';
        }

    } // End of $debug IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');


// ************ ERROR MANAGEMENT ************ //



