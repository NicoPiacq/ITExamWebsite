<?php

error_reporting(E_ALL);
session_start();
include("conn_db.php");

$_SESSION["ADMusername"]=$_POST["ADMUser"]; 
$_SESSION["ADMpassword"]=$_POST["ADMpwd"];

echo "".$_SESSION["ADMusername"]."";

if (!isset($_SESSION["ADMusername"])) {
		header("Location: login.php");
}
else {
	$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["ADMusername"]."'") OR printf(mysqli_error($CONN));
	$row = mysqli_fetch_assoc($query);

	if(mysqli_num_rows($query) > 0) {
    	$hashedPassword = $row["Psw"];
    	if (!password_verify($_SESSION["ADMpassword"], $hashedPassword)) {
			header("Location: login.php");
        }
        else {
		 	if ($row["Rank"] == 'administrator') {
				header("Location: admin_manager.php");
    	 	}
			else {
				header("Location: login.php");
			}
    	}
   	}
	else {
    	header("Location: login.php");
	}
}
?>
