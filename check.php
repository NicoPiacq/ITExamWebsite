<?php

error_reporting(E_ALL);
session_start();
include("conn_db.php");

$_SESSION["username"]=$_POST["User"]; 
$_SESSION["password"]=$_POST["pwd"];

if (!isset($_SESSION["username"])) {
	header("Location: index.php?msg=needlogin");
}
else {
	$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."'") OR DIE($query."<br>");
	$row = mysqli_fetch_assoc($query);
    $hashedPassword = $row["Psw"];

	if(mysqli_num_rows($query) > 0) {
		if ($row["isBanned"] > 0) {
    		$_SESSION["reason"] = $row["BanReason"];
            $_SESSION["banID"] = $row["ID"];
			header("Location: index.php?msg=accountbanned");
    	}
		else {
        	if (password_verify($_SESSION["password"], $hashedPassword)) {
    			$_SESSION["loggedIn"] = true;
				header("Location: me.php");
            }
            else {
            	header("Location: index.php?msg=unknownfields");
            }
		}
    }
	else {
		header("Location: index.php?msg=unknownfields");
	}
}
?>
