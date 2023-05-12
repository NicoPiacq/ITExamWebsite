<html>
	<head>
	<?php 
        
        
		include("system/page_header.php");
         include("system/page_bottom.html"); 
	?>
		<meta charset="utf-8">
		<title>Pagina di accesso</title>
		<meta name="autore" content="Nicola Piacquaddio">
		<meta name="description" content="Esame di Nicola Piacquaddio">
		
		<!-- SCRIPT PER LA CHIUSURA DELLE FINESTRE DI AVVISO DI LOGIN! -->
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
	<body>
	<br>
	<center>			
			<font>Effettua l'accesso al Sito da qui!</font> <br> <br>
			<form method=post action="check.php">
			<div class="login_zone">
				    <label class='labindex' for="User"><b><font>Inserisci l'Username qui</font></b></label> <br>
				    <input class='inputindex' type="text" placeholder="Nome Utente" name=User required> <br>
				    <label class='labindex' for="pwd"><b><font>Inserisci la Password qui</font></b></label> <br>
				    <input class='inputindex' type="password" placeholder="Password" name=pwd required>
				    <br>
    				<button type=submit>Accedi</button>
			</div> </form>
			<input type=button value="Registrati" onclick="window.location.href='register.php'">
        <br> <br>
			
			<?php
                include("conn_db.php");
                include("mtn_settings.php");
				if ($_GET["msg"] == 'needlogin') {
					echo "<div class='warning_zone' id='warning'> <br>";
                	echo "<b><font>Devi prima effettuare il Login!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
					echo "</div>";
					session_destroy();
                    exit();
				}
                if ($_GET["msg"] == 'unknownfields') {
					echo "<div class='warning_zone' id='warning'> <br>";
                	echo "<b><font>Nome utente o password sono sconosciuti!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
					echo "</div>";
					session_destroy();
                    exit();
				}
				if ($_GET["msg"] == 'accountbanned') {
                	$reason = $_SESSION["reason"];
                    $banID = $_SESSION["banID"];
                    if (isset($reason)) {
						echo "<div class='warning_ban_zone' id='warning'> <br> ";
						echo "<font class='color_info'>Questo account e' stato sospeso! (ID #".$banID.") <br> Motivo: <b>".$reason."</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
						echo "</div>";
                    	session_destroy();
                        exit();
                    }
                    else
                    	header("Location: index.php");
                }
                if ($_GET["msg"] == 'success') {
                	$reg_success_true = $_SESSION["regsuccess"];
                    if (isset($reg_success_true)) {
					echo "<div class='warning_reg_zone' id='warning'> <br>";
					echo "<b><font class='color_info'> Registrazione avvenuta con successo!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
					echo "</div>";
                    	session_destroy();
                        exit();
                    }
                    else
                    	header("Location: index.php");
               	}
                if ($_GET["msg"] == 'logout') {
					echo "<div class='warning_reg_zone' id='warning'> <br>";
					echo "<b><font class='color_info'> Sessione terminata: logout effettuato.</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
					echo "</div>";
                    exit();
                }
                if (isset($_SESSION["username"])) {
                    header("Location: me.php");
                }
            ?>
			
			
	</center>
	</body>
    <footer>
	   <?php include("system/page_bottom.html"); ?>
	</footer>
</html>
