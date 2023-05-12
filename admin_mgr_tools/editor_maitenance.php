<?php

	echo "<title>Gestione Manutenzione</title>";
	
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");
	     
    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");

    $querywebsite = mysqli_query($CONN,"SELECT * FROM WebsiteStatus");
    $rowwebsite = mysqli_fetch_assoc($querywebsite);
        
   	echo "<font class='font_hmpg'><center>Manutenzione</font> <br> <br>";
	echo "<div class=mtn_page>";
    		$MaitenanceStatus = $rowwebsite["Maitenance"];
            if($MaitenanceStatus < 1) {
            	echo "<form method=post action=\"editor_maitenance.php\"> <br>
						<font>Il sito non &egrave; in manutenzione!</font>
                		<br>
                		<input class='mtnBtnNo' type=submit name=\"MtnOk\" value=\"Attiva la manutenzione\">
            			<br>";
            }
            else {
            	echo "<form method=post action=\"editor_maitenance.php\"> <br>
						<font>Il sito &egrave; in manuntenzione!</font>
                		<br>
                        <input class='mtnBtnOk' type=submit name=\"MtnNo\" value=\"Disattiva la manutenzione\">
            			<br>";
            }
            
            if(isset($_POST["MtnOk"])) {
    			mysqli_query($CONN,"UPDATE WebsiteStatus SET Maitenance='1'") OR printf(mysqli_error($CONN));
				header("Location: editor_maitenance.php");
    		}    
            else if(isset($_POST["MtnNo"])) {
    			mysqli_query($CONN,"UPDATE WebsiteStatus SET Maitenance='0'") OR printf(mysqli_error($CONN));
				header("Location: editor_maitenance.php");
    		}
    echo "</div></center>";
	
?>