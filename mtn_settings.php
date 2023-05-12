<?php
	/* THIS PAGE IS ONLY USED BY INDEX, REGISTRATION, 
    	CHECK AND CHECK_REGISTRATION
    	FOR MAITENANCE PURPOSES! */
	
    error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("conn_db.php");
    
    $MainURL = "http://localhost";
	$querywebsite = mysqli_query($CONN,"SELECT * FROM WebsiteStatus");
	$rowwebsite = mysqli_fetch_assoc($querywebsite);
	$MtnStatus = $rowwebsite["Maitenance"];

	if ($MtnStatus > 0)
		header("Refresh:0;$MainURL/maitenance.php");

?>