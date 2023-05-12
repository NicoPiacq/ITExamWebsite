<?php

	echo "<title>User Editor: Consegna privilegi</title>";
	
	error_reporting(E_ALL);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");

    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");

	$UserName = $_SESSION["UserFound"];
	
    echo "<center><div class='ban_space'> <font class='font_hmpg'>Vuoi dare privilegi a <b> ".$UserName."?</b></font> <br> <br>
    		<form method=post action=\"rankup.php\">
            <input class='ban' type=reset value=\"Annulla\" onclick=\"window.location.href='admin_manager.php'\">
            <input class='unban' type=submit name=\"RankUP\" value=\"Consegna privilegi\">
            <br></form></div>";
	
    if(isset($_POST["RankUP"])) {
    	mysqli_query($CONN,"UPDATE utenti SET Rank='administrator' WHERE Name='$UserName'") OR printf(mysqli_error($CONN));
        echo "<div class='warning_reg_zone' id='warning'> <br> ";
        echo "<font class='color_info'> <b>L'account ".$UserName." &egrave; diventato amministratore!</b> <br> Torno indietro... <br> </font>";
        echo "</div>";
        header("Refresh:2;$MainURL/admin_mgr_tools/admin_manager.php");
    }    

?>