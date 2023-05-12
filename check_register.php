<?php
session_start();
include("conn_db.php");
error_reporting(E_ALL);

$username=$_POST["User"];
$psw=$_POST["pwd"];
$birth = $_POST["datepicker"];
$uppercase = preg_match('@[A-Z]@', $psw);
$lowercase = preg_match('@[a-z]@', $psw);
$number = preg_match('@[0-9]@', $psw);
$regverified = null;
$hash_options = [
    'cost' => 11,
];

echo "".$birth."";

if (!$username || !$psw || !$birth) {
    header("Location: register.php?msg=nofields");
}
else {
	if(!$uppercase || !$lowercase || !$number || strlen($psw) < 8) {
  		header("Location: register.php?msg=wrongpsw");
	}
	else {
		$regverified = 1;
	}
}

$sqlquery = "SELECT * FROM utenti WHERE Name = '".$username."'"; 
$result = mysqli_query($CONN,$sqlquery);

if ($regverified == 1) {
	if(mysqli_num_rows($result) == "1") {
        header("Location: register.php?msg=namenotavailable");
	}
	else {
    	$hashed_psw = password_hash($psw, PASSWORD_BCRYPT, $hash_options);
        $_SESSION["regsuccess"] = true;
		mysqli_query($CONN,"INSERT INTO utenti (Name,Psw,Birth) VALUES ('".$username."','".$hashed_psw."','".$birth."')");
        header("Location: index.php?msg=success");

	}
}

?>
