<html> 
	<head>
		<meta charset="utf-8">
		<meta name="autore" content="Nicola Piacquaddio">
		<meta name="description" content="Esame di Nicola Piacquaddio">
		
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

	echo "<title>Aggiungi nuova notizia</title>";
	
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");
    
    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");
    
    if ($_GET["msg"] == 'nofields') {
        echo "<center><div class='warning_reg_zone' id='warning'> <br>";
        echo "<b><font> Campo mancante.</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center><br>";
    }
    else {
        echo "<center><div class='warning_reg_zone' id='warning'> <br>";
        echo "<b><font class='color_info'> &Egrave; necessario usare HTML per scrivere il contenuto della notizia!</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center><br>";
    }

   	echo "<center><font class='font_hmpg'><center>Nuova Notizia</font> <br> <br>";
	echo "<div><font>
			<form method=post action=news_add.php>
            
                Titolo della notizia: <br>
                <textarea type=text class='NewsBox' placeholder=Titolo name='TitleNews'>".$rownews["title"]."</textarea><br>
                Descrizione: <br>
                <textarea type=text class='descNewsBox' placeholder=Descrizione della notizia name='DescNews'>".$rownews["newsHomeText"]."</textarea> <br>
                Contenuto della Notizia: <br>
                <textarea type=text class='bodyNewsBox' placeholder='Scrivi qui il corpo dell&rsquo;articolo in HTML!

Usa i normali tag HTML anche per andare a capo!' name='BodyNews'>".$rownews["newsFullText"]."</textarea> <br>
                Autore: <br>
                <input type=text class='NewsBox' value=".$_SESSION["username"]." name='AuthorNews' disabled> <br>
                
                <input class='btnEditNews' type=submit value=Pubblica Notizia>
                
            </form></div></center></font>";  

?>