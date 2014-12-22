<?php 

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "zoompress");



$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if (mysqli_connect_errno()) {
	die("Database connection failed").mysqli_connect_error()."(".mysqli_connect_errno().")" ;
} else {
	// echo "connection successful"."<br />";
	
}
?>