<?php
session_start();
include("../conn_db.php");
error_reporting(E_ALL);

$username = $_SESSION["username"];
$oldpsw = $_POST["NowPassword"];
$newpsw = $_POST["NewPassword"];
$newpswrepeat = $_POST["NewPasswordRepeat"];
$uppercase = preg_match('@[A-Z]@', $newpsw);
$lowercase = preg_match('@[a-z]@', $newpsw);
$number = preg_match('@[0-9]@', $newpsw);
$hash_options = [
    'cost' => 11,
];

if (!$oldpsw || !$newpsw || !$newpswrepeat)
    header("Location: change_password.php?msg=nofields");

$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."'") OR DIE($query."<br>");
$row = mysqli_fetch_assoc($query);
$oldhashedPassword = $row["Psw"];

if (password_verify($oldpsw, $oldhashedPassword)) {
        
    if (!$uppercase || !$lowercase || !$number || strlen($newpsw) < 8)
  		header("Location: change_password.php?msg=wrongnewpsw");
        
    else if (strcmp($newpsw, $newpswrepeat) == 0) {
        $hashed_psw = password_hash($newpsw, PASSWORD_BCRYPT, $hash_options);
        mysqli_query($CONN,"UPDATE utenti SET Psw='$hashed_psw' WHERE Name='$username'");
        header("Location: change_password.php?msg=success");
    }
    else {
        header("Location: change_password.php?msg=wrongrepeat");
    }
}
else {
    header("Location: change_password.php?msg=wrongoldpsw");
}

?>
