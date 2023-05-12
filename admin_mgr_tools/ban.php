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

	echo "<title>User Editor: Sospendi account</title>";

	error_reporting(E_ALL);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");
    
    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");

	$UserNameBanned = $_SESSION["UserFound"];
	
    echo "<center><div class='ban_space'> <font class='font_hmpg'>Sospendi <b> ".$UserNameBanned." </b> </font> <br> <br>
    		<form method=post action=\"ban.php\"> <br>
            <font>Scegli una motivazione: <br> <input type=text name=BanReason>
            <input class='ban' type=submit value=\"Sospendi account\">
            <br> <br> </form> </div>";

    if(isset($_POST["BanReason"])) {
        if (((!empty($_POST["BanReason"])))) {
            $BanReason = $_POST["BanReason"];
    	    mysqli_query($CONN,"UPDATE utenti SET isBanned='1' WHERE Name='$UserNameBanned'") OR printf(mysqli_error($CONN));
            mysqli_query($CONN,"UPDATE utenti SET BanReason='$BanReason' WHERE Name='$UserNameBanned'") OR printf(mysqli_error($CONN));
            if (strcmp($_SESSION["Rank"], "administrator") == 0) {
                mysqli_query($CONN,"UPDATE utenti SET Rank='normal' WHERE Name='$UserNameBanned'");
                echo "<div class='warning_zone' id='warning'> <br> ";
                echo "<font class='color_info'> L'account amministratore <b>".$UserName."</b> &egrave; stato sospeso e i suoi privilegi rimossi! <br> Motivo: <b>".$BanReason."</b> <br> Torno indietro... <br> </font>";
                echo "</div>";
                header("Refresh:5;$MainURL/admin_mgr_tools/admin_manager.php");
            } 
            else {
                echo "<div class='warning_zone' id='warning'> <br> ";
                echo "<font class='color_info'> L'account <b>".$UserName."</b> &egrave; stato sospeso! <br> Motivo: <b>".$BanReason."</b> <br> Torno indietro... <br> </font>";
                echo "</div>";
                header("Refresh:5;$MainURL/admin_mgr_tools/admin_manager.php");
            }
        }
        else {
            echo "<div class='warning_ban_zone' id='warning'> <br> ";
            echo "<font class='color_info'> <b>Devi specificare il motivo della sospensione!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
            echo "</div>";
        }
    }
?>