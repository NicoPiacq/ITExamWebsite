<html>
	<body>
		<?php 
		include("system/page_header.php");
		?>
		
		<title>Sito in manutenzione</title>
    	<h1><center><font>SITO IN MANUTENZIONE!</font></center></h1>
		<meta name=description content="Pagina di manutezione sito web">
		
		<?php
		
			include("conn_db.php");
			
			if(isset($_SESSION["username"])) {
				$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."'");
				$row = mysqli_fetch_assoc($query);
				
				if ($row["Rank"] == "administrator") {
					echo "<center><input type=button value=\"Pannello di Controllo\" onclick=\"window.location.href='$MainURL/admin_mgr_tools/admin_manager.php'\"></center>";
				}
			}
			
			$querymtn = mysqli_query($CONN,"SELECT * FROM WebsiteStatus");
			$rowmtn = mysqli_fetch_assoc($querymtn);
			$MtnStatus = $rowmtn["Maitenance"];
			
			if ($MtnStatus == 0)
				header("Location: $MainURL/index.php");
		?>
		
    </body>
	<footer>
	<?php include("system/page_bottom.html"); ?>
	</footer>
</html>