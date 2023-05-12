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
	
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");
    
    $querynews = mysqli_query($CONN,"SELECT * FROM websitenews WHERE NID='".$_GET["id"]."'");
    $querycommentlist = mysqli_query($CONN, "SELECT * FROM newscomments INNER JOIN websitenews ON newscomments.NID = websitenews.NID WHERE websitenews.NID='".$_GET["id"]."' ORDER BY newscomments.Published DESC");

	$rownews = mysqli_fetch_assoc($querynews);
    //$commentrow = mysqli_fetch_assoc($querycommentlist);
    
    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");
    
    echo "<title>Modifica la notizia: ".$rownews["title"]."</title>";
    $_SESSION["NewsID"] = $_GET["id"];
    
    if ($_GET["msg"] == 'nofields') {
        echo "<center><div class='warning_zone' id='warning'> <br>";
        echo "<b><font> Campo mancante.</b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center><br>";
    }
    if ($_GET["msg"] == 'updated') {
        echo "<center><div class='warning_reg_zone' id='warning'> <br>";
        echo "<b><font class='color_info'> Notizia aggiornata con successo! </b> <br> <label class='closeTxt' for='ChiudiAvviso'>Chiudi avviso</label> <input type=checkbox id='ChiudiAvviso'> </font> <br>";
        echo "</div></center><br>";
    }  

   	echo "<center><font class='font_hmpg'><center>Editor di Notizie (ID Notizia #".$rownews["NID"].")</font> <br> <br>";
	echo "<div><font>
			<form method=post action=news_update.php>
            
                Titolo della notizia: <br>
                <textarea type=text class='NewsBox' placeholder=Titolo name='TitleNews'>".$rownews["title"]."</textarea><br>
                Descrizione: <br>
                <textarea type=text class='descNewsBox' placeholder=Descrizione della notizia name='DescNews'>".$rownews["newsHomeText"]."</textarea> <br>
                Contenuto della Notizia: <br>
                <textarea type=text class='bodyNewsBox' placeholder=Scrivi qui il corpo dell'articolo name='BodyNews'>".$rownews["newsFullText"]."</textarea> <br>
                Autore: <br>
                <input type=text class='NewsBox' value=".$rownews["author"]." name='AuthorNews' disabled> <br>
                
                <input class='btnEditNews' type=submit value=Modifica ora>
                
            </form></div>
            
            <div class='moderation_part'>
                <b>Moderazione commenti:</b> <br>
                <center><table>
                    <tr>
                        <th>ID</th>
                        <th>Autore</th>
                        <th>Commento</th>
                        <th>Pubblicato il</th>
                        <th>Azioni</th>
                    </tr>";
                    
                    while($datacomment = mysqli_fetch_array($querycommentlist)) {
                        $FoundComment = true;
                        echo "<tr>
                            <td><center>" . $datacomment['ID'] . "</center></td>
                            <td><center>" . $datacomment['Author'] . "</center></td>
                            <td><center>" . $datacomment['Comment'] . "</center></td>
                            <td><center>" . $datacomment['Published'] . "</center></td>
                            <td><center><a class='btnRmvNewsList' name='moderate' href='news_editor.php?id=".$rownews['NID']."&commentId=".$datacomment["ID"]."&delete=yes'>Elimina</a></center></td></tr>";
                    }
                    if ($FoundComment == false) {
                        echo "<b><font class='color_info'><tr>Nessun commento esistente!</tr></font>";
                    }
            echo"</div>
            
            </center></font>";
            

            if (strcmp($_GET["delete"], "yes") == 0) {
                mysqli_query($CONN,"DELETE FROM newscomments WHERE ID='".$_GET["commentId"]."'") or print(mysqli_error($CONN));
                header("Location: news_editor.php?id=".$rownews['NID']."");
            }
?>