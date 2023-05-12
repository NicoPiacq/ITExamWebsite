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

	echo "<title>Gestione Notizie</title>";
	
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");

    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");

    $querynewslist = mysqli_query($CONN,"SELECT * FROM websitenews ORDER BY NID DESC");
    
    echo "<center> <font class='font_hmpg'>Gestione delle Notizie</font> </center> <br>";
    
    if ($_GET["msg"] == 'deleted') {
        echo "<center><div class='warning_reg_zone' id='warning'> <br>";
        echo "<b><font class='color_info'> Notizia eliminata! </b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center><br>";
    }
    if ($_GET["msg"] == 'published') {
        echo "<center><div class='warning_reg_zone' id='warning'> <br>";
        echo "<b><font class='color_info'> Notizia pubblicata! </b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center><br>";
    }
    
    echo "<center><table class='news_page'>
            <tr>
                <th>ID Notizia</th>
                <th>Titolo Notizia</th>
                <th>Autore</th>
                <th>Pubblicata il</th>
                <th>Azioni</th>
            </tr>";
    while($row = mysqli_fetch_array($querynewslist)) {
        echo "<tr>
            <td><center>" . $row['NID'] . "</center></td>
            <td><center>" . $row['title'] . "</center></td>
            <td><center>" . $row['author'] . "</center></td>
            <td><center>" . $row['publishDate'] . "</center></td>
            <td><center><a class='btnEditNewsList' href='news_editor.php?id=".$row['NID']."'>Modifica</a> <a class='btnRmvNewsList' href='news_delete.php?id=".$row['NID']."'>Elimina</a></center></td></tr>";
    }

    echo "</table></div></center>";
    echo "<center><input type=button value=\"Aggiungi Notizia\" onclick=\"window.location.href='news_editor_add.php'\"></center>";

?>