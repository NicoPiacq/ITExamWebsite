<html>

    <head>
    
        <!-- SCRIPT PER LA CHIUSURA DELLE FINESTRE DI AVVISO! -->
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#ChiudiAvviso').change(function () {
					if (!this.checked) 
						$('#warning').fadeIn('slow');
					else 
						$('#warning').fadeOut('slow');
				});
			});
		</script>
        
    </head>
    
</html>

<?php

	echo "<title>User Editor: Rimuovi privilegi</title>";
	
	error_reporting(E_ALL);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");
    
    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");

	$UserName = $_SESSION["UserFound"];
	
    echo "<center><div class='ban_space'> <font class='font_hmpg'>Vuoi rimuovere privilegi a <b> ".$UserName."?</b></font> <br> <br>
    		<form method=post action=\"rankdown.php\">
            <input class='unban' type=reset value=\"Annulla\" onclick=\"window.location.href='admin_manager.php'\">
            <input class='ban' type=submit name=\"RankUP\" value=\"Rimuovi privilegi\">
            <br></form>";
	
    if(isset($_POST["RankUP"])) {
        if (strcmp($_SESSION["username"], $UserName) == 0) {
            echo "<div class='warning_ban_zone' id='warning'> <br> ";
            echo "<font class='color_info'> <b>Non puoi rimuovere i privilegi a te stesso!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
            echo "</div>";
        }
        else { 
            mysqli_query($CONN,"UPDATE utenti SET Rank='normal' WHERE Name='$UserName'") OR printf(mysqli_error($CONN));
            echo "<div class='warning_reg_zone' id='warning'> <br> ";
            echo "<font class='color_info'> <b>L'account ".$UserName." &egrave; diventato utente!</b> <br> Torno indietro... <br> </font>";
            echo "</div>";
            header("Refresh:2;$MainURL/admin_mgr_tools/admin_manager.php");
        }
    }



?>