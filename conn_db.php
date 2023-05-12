<?php
	
	error_reporting(E_ALL & ~E_NOTICE);
	
	// CONNESSIONE AL SERVER
	$CONN = new mysqli('localhost','root','','my_sitopiacquaddio');
	if(!($CONN))
		exit("SERVER LOCALE NON TROVATO");

	// CONNESSIONE AL DATABASE
	$db_selected = mysqli_select_db($CONN,"my_sitopiacquaddio");
	if(!$db_selected) {
		die ('Database selezionato inesistente '.mysql_error());
	}
 
?>