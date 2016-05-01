<?php
// Define the common files
define ('URL', 'http://pinkstarapp.com/');
define ('DB_SERVER', 'localhost');
define ('DB_USER', 'taranjee_pinksta');
define ('DB_PASS', 'Pink@star123');
define('DBNAME', 'taranjee_pinkstar');
/*
 *  This for local host
 */
// define('URL','http://localhost/testrrrr/');
// define( 'DB_SERVER', 'localhost' );
// define( 'DB_USER', 'root' );
// define( 'DB_PASS', 'root' );

/*
 *  Define table names
 */
extract($_REQUEST);
define ('pd','ps_department');
define ('plv','ps_log_vendor');
define ('puv','ps_user_vendor');
define ('pvl','ps_vendor_log');
define ('pp','ps_page');
define ('pu','ps_user');
define ('puad','ps_user_account_details');
define ('pud','ps_user_details');
define ('pur','ps_user_referral');
define ('puec','ps_user_emergency_contact');
define ('pl','ps_location');
define ('pul','ps_user_log');
define('pue','ps_user_experience');
define('plead','ps_lead');
define('pclient','ps_client');



/*
	Define images path
*/
define('employeeimg','uploads/employee/');
define('vendorimg','uploads/employee/');
?>
