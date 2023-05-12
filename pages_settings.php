<?php

	session_start();
	error_reporting(E_ALL & ~E_NOTICE);

	include("conn_db.php");

	$MainURL = "http://nicolapiacquaddio.homepc.it";
	$querywebsite = mysqli_query($CONN,"SELECT * FROM WebsiteStatus");
	$rowwebsite = mysqli_fetch_assoc($querywebsite);
	$MtnStatus = $rowwebsite["Maitenance"];

	if ($MtnStatus > 0)
		header("Refresh:0;$MainURL/maitenance.php");

	$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."' AND Psw ='".$_SESSION["password"]."'") OR DIE($query."<br>");
	$row = mysqli_fetch_assoc($query);

	if ($row["isBanned"] > 0) {
		$_SESSION["reason"] = $row["BanReason"];
		header("Location: index.php?msg=accountbanned");
	}
	
	if (!isset($_SESSION["username"])) {
		header("Location: $MainURL/index.php?msg=needlogin");
	}

?>