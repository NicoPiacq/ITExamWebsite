<html>
	<head>
		<title>Accesso al Pannello di Controllo</title>
	</head>
	<body>
	
	<?php
		session_start();
		include("conn_db.php");
		
		if (isset($_SESSION["username"])) {
			
			$queryusermanager = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."'");
			$rowusermanager = mysqli_fetch_assoc($queryusermanager);
			
			if($rowusermanager["Rank"] == "administrator") {
				header("Location: admin_manager.php");
			}
		}
	?>
	
	<center>
		<fieldset style="width:30%"><legend>Accesso Area Riservata</legend>
            <br>
			<form method=post action="check.php">
				Username: <input type="text" name=ADMUser>
				<br>
				Password: <input type="password" name=ADMpwd>
				<br>
				<input type=submit value="Entra">
			</form>
		</fieldset>
	</center>
	</body>
</html>
