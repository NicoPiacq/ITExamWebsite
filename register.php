<html>
	<head>
		<title>Pagina di Registrazione</title>
		<?php include("system/page_header.php"); ?>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	</head>
	<body>
		<br>
		<center><font class=font_hmpg>Benvenuti nella pagina di Registrazione Utente</font></center> <br>
		<center>
			<div class=reg_zone><font>
				<form method=post action="check_register.php">
					Username: <br> <input type="text" name=User required>
                    <br>
					Password: <br> <input class=passbox type="password" name=pwd required></a>
					<div class=passbox>La password ha bisogno di 8 caratteri di cui: <br> 1 Maiuscola, 1 Minuscola e 1 Numero!</div>
  					<script>
  						$( function() {
    						$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  						} );
  					</script>
					<br>
                    <p>Data di nascita: <br> <input type="text" id="datepicker" name="datepicker" required></p>
                    <input class=regReset type=reset value="Svuota i campi">
					<input class=regOk type=submit value="Registrati">
				</form></font>
				
				<?php 
                    include("conn_db.php");
                	include("mtn_settings.php");
                    if($_GET["msg"] == 'namenotavailable') {
						echo "<div class='warning_zone'> <br>";
						echo "<b><font>Il nome inserito non &egrave; disponibile<font></b> <br> <br>";
						echo "</div>";
					}
                    if($_GET["msg"] == 'wrongpsw') {
						echo "<div class='warning_zone'> <br>";
						echo "<b><font>La password non &egrave adatta<font></b> <br> <br>";
						echo "</div>";
					}
                ?>			
		</center>
	</body>
	<footer>
	<?php include("system/page_bottom.html"); ?>
	</footer>
</html>
