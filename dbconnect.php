<!--/**
 * Name: ONYINYE ILOANUGO
 * StudentId: 2009808
 * CourseCode: CMM 004
 * Course: Software Engineering Project
 * 
 */


/**
 * * CREATED AN AWS ACCOUNT
 * CONNECTED TO THE AWS CLOUD
 * 
 * 
 */-->


<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'OADB');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
/*Connecting pages to the database */
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


/////////////////////////////////////////////////////////////////////
//testing AWS: use the local host to test before using AWS RDS UP THERE....//////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

/**
 * Name: OLIVIA
 * StudentId: 
 * CourseCode: 
 * Course: Software Engineering Project
 * 
 */


/**  CONNECTION TO THE LOCAL HOST FOR INITIAL TESTING
 * * 
 * 
 * 
 * 
 */



///define('DB_SERVER', 'localhost');
///define('DB_USERNAME', 'TeamC');
///define('DB_PASSWORD', 'TeamC004');
///define('DB_DATABASE', 'collaborations');
///$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
/*Connecting pages to the database */



// Check connection
///if ($db->connect_error) {
    ///die("Connection failed: " . $conn->connect_error);
///}else
   ///{echo "success";

   ///}
?>