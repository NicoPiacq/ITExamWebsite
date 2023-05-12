<?php

	echo "<title>User Editor: Rimuovi sospensione</title>";
	
	error_reporting(E_ALL);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");
    
    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");

	$UserNameBanned = $_SESSION["UserFound"];
	
    echo "<center><div class='ban_space'> <font class='font_hmpg'>Rimuovi sospensione a <b> ".$UserNameBanned." </b></font> <br> <br>
    		<form method=post action=\"unban.php\">
            <input class='ban' type=reset value=\"Annulla\" onclick=\"window.location.href='admin_manager.php'\">
            <input class='unban' type=submit name=\"UnbanCmd\" value=\"Rimuovi la sospensione\">
            <br> </form> </div>";
	
    if(isset($_POST["UnbanCmd"])) {
    	mysqli_query($CONN,"UPDATE utenti SET isBanned='0' WHERE Name='$UserNameBanned'") OR printf(mysqli_error($CONN));
        mysqli_query($CONN,"UPDATE utenti SET BanReason='NULL' WHERE Name='$UserNameBanned'") OR printf(mysqli_error($CONN));
        echo "<div class='warning_reg_zone' id='warning'> <br> ";
        echo "<font class='color_info'> <b>L'account ".$UserNameBanned." &egrave; stato sbloccato!</b> <br> Torno indietro... <br> </font>";
        echo "</div>";
        header("Refresh:2;$MainURL/admin_mgr_tools/admin_manager.php");
    }
    else {
        echo "<div class='warning_zone' id='warning'> <br> ";
        echo "<font class='color_info'> Motivo sospensione: <br> <b>".$_SESSION["banReason"]."</b> <br></font> <br>";
        echo "</div>";
    }

?>