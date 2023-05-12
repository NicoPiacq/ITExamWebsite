<html>
    <head>
        <!-- SCRIPT PER LA CHIUSURA DELLE FINESTRE DI AVVISO -->
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
	
    session_start();
	echo "<title>Modifica password</title>";
    
	error_reporting(E_ALL & ~E_NOTICE);

	include("conn_db.php");
	include("mtn_settings.php");    
    include("../system/page_bottom.html");
	include("../system/page_header.php");

	$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."'") or die();
	$row = mysqli_fetch_assoc($query);
	
    echo "<div class:'user_find'><font class='font_hmpg'><center>Modifica la tua password</font> <br>
        	<br> <font>
            <form method=post action=\"execute_password.php\"> <br>
            Inserisci la password attuale: <br> <input type=password name=NowPassword> <br>
            Inserisci la password nuova: <br> <input type=password name=NewPassword> <br>
            Ripeti la password nuova: <br> <input type=password name=NewPasswordRepeat> <br>
            <input class='unban' type=submit name=\"changer\" value=\"Cambia la Password\">";
    echo "</div></center></font>";
	
    if ($_GET["msg"] == 'nofields') {
        echo "<center><div class='warning_zone' id='warning'> <br>";
        echo "<b><font>Ci sono dei campi mancanti!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center>";
    }
    if ($_GET["msg"] == 'wrongnewpsw') {
        echo "<center><div class='warning_zone' id='warning'> <br>";
        echo "<b><font>La password nuova non rispetta i requisiti!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center>";
    }
    if ($_GET["msg"] == 'success') {
        echo "<center><div class='warning_reg_zone' id='warning'> <br>";
        echo "<b><font>Password cambiata con successo!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center>";
    }
    if ($_GET["msg"] == 'wrongrepeat') {
        echo "<center><div class='warning_zone' id='warning'> <br>";
        echo "<b><font>Le password nuove non sono uguali!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center>";
    }
    if ($_GET["msg"] == 'wrongoldpsw') {
        echo "<center><div class='warning_zone' id='warning'> <br>";
        echo "<b><font>La password attuale non &egrave; corretta!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center>";
    }

?>