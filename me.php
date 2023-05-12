<html>
	<head>
		<title>Homepage</title>
	</head>
	<body>
		<?php

			error_reporting(E_ALL);
			include("conn_db.php");
			include("pages_settings.php");
			include("system/page_header.php");

			$UserName = $_SESSION["username"];
            $_SESSION["usertype"] = $row["Rank"];
			$query = mysqli_query($CONN,"SELECT * FROM utenti WHERE Name='".$_SESSION["username"]."'");
			$row = mysqli_fetch_assoc($query);

			$_SESSION["usertype"] = $row["Rank"];
            $Birth = date("d/m/Y",strtotime($row["Birth"]));
            $RegDate = date("d/m/Y H:i:s",strtotime($row["regDate"]));
        
		echo "<center><font class='font_hmpg'>Benvenuto nella tua pagina, <b>".$_SESSION["username"]."</b>!</font></center>";
		echo "<br>";
		echo "<center><div class='user_personal'>
                Account ID: <b> ".$row["ID"]." </b>
                <br>";
				switch($row["Rank"]) {
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
                Data di nascita: <b>".$Birth."</b>
				<br>
                Data di registrazione: <b>".$RegDate."</b>
        		</div></center>";
        
        echo "<center><input type=button class='unban' value=\"Cambia Password\" onclick=\"window.location.href='$MainURL/user_editor/change_password.php'\"></center>";
        
         if($_SESSION["usertype"] == 'administrator') {
         	echo "<center><input type=button value=\"Pannello di Controllo\" onclick=\"window.location.href='$MainURL/admin_mgr_tools/admin_manager.php'\"></center>";
         }
        ?>
        
        <br> <br>
        <font>Ultima notizia dal Blog</font>
        <div class="news_zone">
            
               <?php 
                    
                    $querynews = mysqli_query($CONN,"SELECT * FROM websitenews WHERE NID IN (SELECT MAX(NID) FROM websitenews)");
	                $rownews = mysqli_fetch_assoc($querynews);
                    
                    echo "<center><font class='newsTitle'>".$rownews["title"]."</font>";
                    echo "<br><font class='newsDesc'>".$rownews["newsHomeText"]."</font>";
                    echo "<br> <br>";
                    echo "<center><font class='newsRead'><a class='readNews' href='news.php?id=".$rownews["NID"]."'>Leggi</a></font></center>";
                    
                ?> 
                
        </div>
    </body>
	<footer>
	<?php include("system/page_bottom.html"); ?>
	</footer>
</html>