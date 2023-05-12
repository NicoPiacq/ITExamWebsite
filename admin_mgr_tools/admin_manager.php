<?php
	
	echo "<title>User Editor</title>";
	
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");

    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");
	
    echo "<div class:'user_find'><font class='font_hmpg'><center>User Editor</font> <br>
        	<br> <font>
            <form method=post action=\"admin_manager.php\"> <br>
            Inserisci il nome utente: <br> <input type=text name=UserFind>
            <input class='btnSearch' type=submit name=\"searcher\" value=\"Cerca\">";
    
    if (isset($_POST["UserFind"]))
		$_SESSION["UserFound"] = $_POST["UserFind"];
    
    $queryusermanager = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["UserFound"]."'");
	$rowusermanager = mysqli_fetch_assoc($queryusermanager);
    
    $Birth = date("d/m/Y",strtotime($rowusermanager["Birth"]));
    $RegDate = date("d/m/Y H:i:s",strtotime($rowusermanager["regDate"]));
    $_SESSION["banReason"] = $rowusermanager["BanReason"];
    $_SESSION["Rank"] = $rowusermanager["Rank"];
    
    if(mysqli_num_rows($queryusermanager) > 0) {
        echo "<br> <br>";
        echo "Ho trovato questo utente: <b> ".$_SESSION["UserFound"]."! </b> <br> <br>
				Account ID: <b>".$rowusermanager["ID"]."</b>
				<br>";
				switch($rowusermanager["Rank"]) {
					case "normal": {
						echo "Tipo account: <b>Utente</b>";
						break;
					}
					case "administrator": {
						echo "Tipo account: <b>Amministratore</b>";
						break;
					}
				}
				echo "<br>
                Data di registrazione: <b>".$RegDate."</b>
				<br>
				Data di nascita: <b>".$Birth."</b>
				<br>";
                if ($rowusermanager["isBanned"] < 1) {
                	echo "Account Sospeso: <b>No</b>
                    		<br>
                    		<input class=ban type=reset value=\"Sospendi questo account\" onclick=\"window.location.href='ban.php'\"> ";
                    switch($rowusermanager["Rank"]) {
                        case "normal": {
                            echo "<input class=unban type=reset value=\"Consegna privilegi\" onclick=\"window.location.href='rankup.php'\"> <br> <br>";
                            break;
                        }
                        case "administrator": {
                            echo "<input class=ban type=reset value=\"Rimuovi privilegi\" onclick=\"window.location.href='rankdown.php'\"> <br> <br>";
                            break;
                        }
                    }
                }
                else {
                	echo "Account Sospeso: <b>Si</b>
                    <br>
                    Motivo: <b>".$rowusermanager["BanReason"]."</b>
                    <br>
                    <input class=unban type=reset value=\"Rimuovi la sospensione\" onclick=\"window.location.href='unban.php'\"> <br> <br>";
                }
	}
    else {
    	echo "<h3>Non ho trovato nessun utente!</h3>";
		echo "</div></center></font>";
    }
	
?>